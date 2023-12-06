<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Mail\UserRegistered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Monarobase\CountryList\CountryListFacade;
use Illuminate\Support\Facades\Validator;

class UserList extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }



    public function search(Request $request)
    {
        if ($request->ajax()) {
            $query = User::query()->withRole('client');

            // Count the total number of records before filtering
            $totalRecords = $query->count();
            if ($request->filled('pays')) {
                $pays = $request->input('pays');
                $query->where('pays', $pays);
            }
            if ($request->filled('search')) {
                $searchValue = $request->input('search');
                $query->where(function ($query) use ($searchValue) {
                    $query->where('name', 'like', "%$searchValue%")
                        ->orWhere('email', 'like', "%$searchValue%")
                        ->orWhere('role', 'like', "%$searchValue%")
                        ->orWhere('pays', 'like', "%$searchValue%")
                        ->orWhere('numero', 'like', "%$searchValue%")
                        ->orWhere('genre', 'like', "%$searchValue%");
                });
            }

            // Count the number of records after filtering
            $filteredRecords = $query->count();

            // Handle pagination
            $start = $request->input('start', 0); // Initialize to 0
            $length = 10; // Always set length to 10

            $clientUsers = $query
                ->skip($start)
                ->take($length)
                ->get();

            $data = [];
            foreach ($clientUsers as $user) {
                $data[] = [
                    'name' => '<div class="d-flex justify-content-start align-items-center user-name">' .
                        ($user->image
                            ? '<div class="avatar me-3"><img src="/storage/' . $user->image . '" alt="Avatar" class="rounded-circle"></div>'
                            : '<div class="avatar me-3"><img src="https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=104d93&color=fff" alt="Avatar" class="rounded-circle"></div>'
                        ) .
                        '<div class="d-flex flex-column"><span class="fw-medium">' . $user->name . '</span><small class="text-muted">' . $user->email . '</small></div></div>',
                    'role' => '<span class="text-truncate d-flex align-items-center"><span class="badge badge-center rounded-pill bg-label-warning w-px-30 h-px-30 me-2"><i class="ti ti-user ti-sm"></i></span>' . $user->role . '</span>',
                    'pays' => $user->pays,
                    'numero' => $user->numero,
                    'genre' => $user->genre,
                    'actions' => '<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-' . $user->id . '"><i class="ti ti-trash"></i> </button>
                    <div class="modal fade" id="exampleModal-' . $user->id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title fs-5" id="deleteModalLabel">Confirmer la suppression</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                             Êtes-vous sûr de vouloir supprimer cet utilisateur ' . $user->name . '  ?
                           </div>
                           <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                             <form action="/users/' . $user->id . '" method="POST">
                             ' . csrf_field() . '
                               ' . method_field('DELETE') . '
                               <button type="submit" class="btn btn-danger">Supprimer</button>
                             </form>
                           </div>
                         </div>
                       </div>
                     </div>'
                ];
            }

            $response = [
                'data' => $data,
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
            ];
            return response()->json($response);
        }
    }

    public function index(Request $request)
    {

        // Retrieve all users with the "client" role using a scope method 'withRole' (custom method)
        $clientUsers = User::withRole('client')->get();
        $countries = CountryListFacade::getList('en');
        // Count the number of users with the "client" role
        $clientUsersCount = $clientUsers->count();
        $maleUserCount = $clientUsers->where('genre', 'Homme')->count();
        $femaleUserCount = $clientUsers->where('genre', 'Femme')->count();
        // Calculate the previous count of client users (replace with your logic)
        // $previousClientUsersCount = User::where('role', 'client')
        //     ->where('created_at', '<', now()) // Adjust the date condition as needed
        //     ->count();
        // // Calculate the percentage increase
        // $percentageIncrease = ($clientUsersCount - $previousClientUsersCount) / $previousClientUsersCount * 100;

        // Pass the list of client users, their count, and percentage increase to the view
        return view('content.apps.app-user-list', [
            'clientUsers' => $clientUsers,
            'clientUsersCount' => $clientUsersCount,
            'countries' => $countries,
            'maleUserCount' => $maleUserCount,
            'femaleUserCount' => $femaleUserCount,

            // 'percentageIncrease' => $percentageIncrease,
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Delete related reservations and elements_de_paniers
        $user->reservations->each(function ($reservation) {
            // Check if reservation has elements_de_paniers
            if ($reservation->elementDePanier) {
                $reservation->elementDePanier->each(function ($element) {
                    // Check if reservation_id is not null before attempting to delete
                    if ($element->reservation_id !== null) {
                        $element->delete();
                    }
                });
            }

            $reservation->delete();
        });

        // Delete related paniers and their associated elements_de_paniers
        $user->paniers->each(function ($panier) {
            $panier->elementDePanier->each(function ($element) {
                $element->delete();
            });

            $panier->delete();
        });

        // Finally, delete the user
        $user->delete();

        return redirect()->route('app-user-list')->with('success', 'Utilisateur supprimé avec succès.');
    }






    public function addUser(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:4',
            'genre' => 'required|string',
            'pays' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('app-user-list') // Adjust the route name accordingly
                ->withErrors($validator)
                ->withInput();
        }


        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/users/' . $imageName;
            $image->storeAs('public', $imagePath); // You can customize the storage path
        }

        // Create the user
        $user = User::create([
            'name' => $request->input('name'),
            'genre' => $request->input('genre'),
            'pays' => $request->input('pays'),
            'numero' => $request->input('phone'),
            'image' => $imagePath, // Save the image path in the database
            'role' => 'client', // You can set the role here or based on your logic
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        // You can add any additional logic you need here, such as sending emails or performing other actions.
        // Mail::to($user->email)->send(new UserRegistered($user));

        try {
            Mail::to($user->email)->queue(new UserRegistered($user));
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
        return redirect()->route('app-user-list')->with('success', 'Utilisateur ajouté avec succès.');
    }
}
