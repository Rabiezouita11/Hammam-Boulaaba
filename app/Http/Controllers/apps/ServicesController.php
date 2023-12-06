<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\Element_de_panier;
use App\Models\Panier;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $query = Service::query();

            // Count the total number of records before filtering
            $totalRecords = $query->count();
            // if ($request->filled('pays')) {
            //     $pays = $request->input('pays');
            //     $query->where('pays', $pays);
            // }
            if ($request->filled('search')) {
                $searchValue = $request->input('search');
                $query->where(function ($query) use ($searchValue) {
                    $query
                        ->where('Designations', 'like', "%$searchValue%")
                        ->orWhere('prix', 'like', "%$searchValue%")
                        ->orWhere('categories', 'like', "%$searchValue%");
                });
            }

            // Count the number of records after filtering
            $filteredRecords = $query->count();

            // Handle pagination
            $start = $request->input('start', 0);  // Initialize to 0
            $length = 10;  // Always set length to 10

            $Services = $query
                ->skip($start)
                ->take($length)
                ->get();

            $data = [];
            foreach ($Services as $user) {
                $data[] = [
                    'Designations' => '<div class="d-flex justify-content-start align-items-center user-name">'
                        . ($user->image
                            ? '<div class="avatar me-3"><img src="/storage/' . $user->image . '" alt="Avatar" class="rounded-circle"></div>'
                            : '<div class="avatar me-3"><img src="https://ui-avatars.com/api/?name=' . urlencode($user->Designations) . '&background=104d93&color=fff" alt="Avatar" class="rounded-circle"></div>')
                        . '<div class="d-flex flex-column"><span class="fw-medium">' . $user->Designations . '</span></div></div>',
                    'prix' => '<span class="text-truncate d-flex align-items-center"><span class="badge badge-center rounded-pill bg-label-warning w-px-30 h-px-30 me-2"></span>' . number_format($user->prix) . ' TND</span>',
                    'categories' => $user->categories,
                    'capacite' => isset($user->capacite) && $user->methode_tarification !== 'par_reservation'
                        ? $user->capacite
                        : '<i class="fas fa-ban text-danger"></i>',
                    'duree' => ($user->dure > 0 ? '<i class="fas fa-clock"></i> ' . $user->dure . ' heures' : '') .
                        ($user->minutes > 0 ? ($user->dure > 0 ? ' et ' : '') . '<i class="fas fa-hourglass"></i> ' . $user->minutes . ' minutes' : ''),
                    'Pause' => $user->pause > 0 ? '<i class="fas fa-pause"></i> ' . $user->pause . ' minutes' : '<i class="fas fa-pause"></i> Aucune pause',
                    'Promotion' => $user->promotion
                        ? '<i class="fas fa-tag"></i> En promotion'
                        : '<i class="fas fa-tag"></i> Pas de promotion',
                    'MethodedeTarification' => $user->methode_tarification === 'par_place'
                        ? '<i class="fas fa-building"></i> Par Place'
                        : '<i class="fas fa-calendar-alt"></i> Par Réservation',
                    'actions' => '<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-' . $user->id . '"><i class="ti ti-trash"></i> </button>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-' . $user->id . '"><i class="ti ti-pencil"></i> </button>
                  
                    <div class="modal fade" id="exampleModal-' . $user->id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title fs-5" id="deleteModalLabel">Confirmer la suppression</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                             Êtes-vous sûr de vouloir supprimer cet service  ' . $user->Designations . '?
                           </div>
                           <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                             <form action="/service/' . $user->id . '" method="POST">

                               ' . csrf_field() . '
                               ' . method_field('DELETE') . '
                               <button type="submit" class="btn btn-danger">Supprimer</button>
                             </form>
                           </div>
                         </div>
                       </div>
                     </div>
                     <div class="modal fade" id="editModal-' . $user->id . '" tabindex="-1" aria-labelledby="editModalLabel-' . $user->id . '" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fs-5" id="editModalLabel-' . $user->id . '">Modifier le service ' . $user->Designations . '</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">                           
                            <form action="/updateService/' . $user->id . '" method="POST" enctype="multipart/form-data">

                            ' . csrf_field() . '
                                    ' . method_field('PUT') . '
                                    <div class="mb-3">
                                        <label class="form-label" for="edit-Designations-' . $user->id . '">Designations</label>
                                        <input type="text" class="form-control" id="edit-Designations-' . $user->id . '" name="edit-Designations" value="' . $user->Designations . '" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="edit-prix-' . $user->id . '">Prix</label>
                                        <input type="number" class="form-control" id="edit-prix-' . $user->id . '" name="edit-prix" value="' . $user->prix . '" required>
                                    </div>
                                    <div class="mb-3">
                                    <label class="form-label">Promotion</label>
                                    <div class="custom-control custom-switch">
                                    <input class="custom-control-input" type="checkbox" id="promotion" name="edit-promotion" ' . ($user->promotion ? 'checked' : '') . '>
                                        <label class="custom-control-label" for="promotion">Activer la promotion</label>
                                    </div>
                                </div>
                                    <div class="mb-3">
                                    <label class="form-label" for="edit-category-' . $user->id . '">Category</label>
                                    <select class="form-select" name="edit-category" required>
                                        <option value="">Select a category</option>
                                        <option value="MASSAGES" ' . ($user->categories === 'MASSAGES' ? 'selected' : '') . '>MASSAGES</option>
                                        <option value="SOINS ESTHÉTIQUES" ' . ($user->categories === 'SOINS ESTHÉTIQUES' ? 'selected' : '') . '>SOINS ESTHÉTIQUES</option>

                                        <option value="LA COLINA LOUNGE et CLUB" ' . ($user->categories === 'LA COLINA LOUNGE et CLUB' ? 'selected' : '') . '>LA COLINA LOUNGE & CLUB</option>
                                        <option value="PRESTATIONS THERMALES" ' . ($user->categories === 'PRESTATIONS THERMALES' ? 'selected' : '') . '>PRESTATIONS THERMALES</option>

                                        <option value="VOS ÉVÉNEMENTS" ' . ($user->categories === 'VOS ÉVÉNEMENTS' ? 'selected' : '') . '>VOS ÉVÉNEMENTS</option>

                                        <option value="BUNGALOWS" ' . ($user->categories === 'BUNGALOWS' ? 'selected' : '') . '>BUNGALOWS</option>

                                    </select>
                                    <div class="mb-3">
                                    <label class="form-label" for="edit-description-' . $user->id . '">Description</label>
                                    <textarea class="form-control" id="edit-description-' . $user->id . '" name="edit-description" style="width: 100%; height: 131px;" required>' . $user->Description . '</textarea>
                                    </div>
                                <div class="mb-3">
                                <label class="form-label" for="edit-capacite-' . $user->id . '">capacite</label>
                                <input type="number" class="form-control" id="edit-capacite-' . $user->id . '" name="edit-capacite" value="' . $user->capacite . '" required>
                            </div>
                             <div class="mb-3">
                                <label class="form-label" for="edit-dure-' . $user->id . '">durée (Heures) </label>
                                <input type="number" class="form-control" id="edit-dure-' . $user->id . '" name="edit-dure-heures" value="' . $user->dure . '" required>
                            </div>
                            <div class="mb-3">
    <label class="form-label" for="edit-dure-minutes-' . $user->id . '">durée (minutes)</label>
    <input type="number" class="form-control" id="edit-dure-minutes-' . $user->id . '" name="edit-dure-minutes" value="' . $user->minutes . '" required>
</div>
<div class="mb-3">
<label class="form-label" for="edit-dure-Pause-' . $user->id . '">Pause (minutes)</label>
<input type="number" class="form-control" id="edit-dure-Pause-' . $user->id . '" name="edit-Pause" value="' . $user->pause . '" required>
</div>
                            <div class="mb-3">
    <label class="form-label" for="edit-methode-tarification-' . $user->id . '">Méthode de Tarification</label>
    <select class="form-select" id="edit-methode-tarification-' . $user->id . '" name="edit-methode-tarification" required>
        <option value="par_place" ' . ($user->methode_tarification === 'par_place' ? 'selected' : '') . '>Par Place</option>
        <option value="par_reservation" ' . ($user->methode_tarification === 'par_reservation' ? 'selected' : '') . '>Par Réservation</option>
        <!-- Add more options if needed -->
    </select>
</div>
                                </div>
                                <div class="mb-3">
                                <label class="form-label" for="edit-image-' . $user->id . '">Image</label>
                              
                                <div class="mb-2 d-flex justify-content-center">
                                <img src="/storage/' . $user->image . '" alt="Current Image" class="img-thumbnail rounded-circle" width="300" height="300">
                                </div>
                         
                                <input type="file" class="form-control" id="edit-image-' . $user->id . '" name="edit-image">
                            </div>
                             
                                    
                                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> 
                     
                     '
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

    public function index()
    {
        // Retrieve all users with the "client" role using a scope method 'withRole' (custom method)
        $Services = Service::all();

        // Count the number of users with the "client" role
        $ServicesCount = $Services->count();

        $maxDurationService = $Services->sortByDesc('dure')->first();

        // Find the service with the maximum price
        $maxPriceService = $Services->sortByDesc('prix')->first();

        // Find the service with the maximum capacity
        $maxCapacityService = $Services->sortByDesc('capacite')->first();

        // Pass the list of client users, their count, and percentage increase to the view
        return view('content.apps.app-user-services', [
            'Services' => $Services,
            'ServicesCount' => $ServicesCount,
            'maxDurationService' => $maxDurationService,
            'maxPriceService' => $maxPriceService,
            'maxCapacityService' => $maxCapacityService,
            // 'percentageIncrease' => $percentageIncrease,
        ]);
    }

    public function destroy($id)
    {
        // Find the service
        $service = Service::findOrFail($id);

        // Find and delete related element_de_paniers records
        $relatedPaniers = Panier::where('service_id', $id)->get();
        foreach ($relatedPaniers as $panier) {
            // Find and delete related element_de_paniers records
            Element_de_panier::where('panier_id', $panier->id)->delete();
            $panier->delete();
        }

        // Delete the service and its image
        $oldImagePath = $service->image;
        if ($oldImagePath) {
            Storage::disk('public')->delete($oldImagePath);
        }
        $service->delete();

        return redirect()->route('app-Services-Services')->with('success', 'Service supprimé avec succès.');
    }

    public function update(Request $request, $id)
    {
        // Find the service by ID
        $service = Service::find($id);

        $oldImagePath = $service->image;

        if (!$service) {
            return redirect()->route('app-Services-Services')->with('error', 'Service not found');
        }

        // Update service fields
        $service->Designations = $request->input('edit-Designations');
        $service->prix = $request->input('edit-prix');
        $service->categories = $request->input('edit-category');
        $service->Description = $request->input('edit-description');


        $service->dure = $request->input('edit-dure-heures');
        $service->minutes = $request->input('edit-dure-minutes');
        $service->pause = $request->input('edit-Pause');
        $service->promotion = $request->has('edit-promotion');



        $service->methode_tarification = $request->input('edit-methode-tarification');

        // Conditionally set the capacite based on methode_tarification
        if ($request->input('edit-methode-tarification') == 'par_reservation') {
            $service->capacite = 1;  // Set capacite to 1 if methode_tarification is 'par_reservation'
        } else {
            $service->capacite = $request->input('edit-capacite');  // Set capacite to the provided value
        }

        // Handle image upload
        if ($request->hasFile('edit-image')) {
            $image = $request->file('edit-image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/Service/' . $imageName;

            // Store the image using Laravel's storage system
            $image->storeAs('public', $imagePath);

            $service->image = $imagePath;

            if ($oldImagePath) {
                Storage::disk('public')->delete($oldImagePath);
            }
        }

        // Save the updated service
        $service->update();

        return redirect()->route('app-Services-Services')->with('success', 'Service mis à jour avec succès');
    }

    public function addService(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'Designations' => 'required|string',
            'prix' => 'required|numeric',  // Use "numeric" to validate that "prix" is a number
            'categories' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',  // Set the max size to 2048 KB (2 MB)
            'Description' => 'required|string',
            'capacite' => 'numeric|nullable',
            'dure_hours' => 'numeric|nullable',
            'dure_minutes' => 'numeric|nullable',
            'pause' => 'numeric|nullable',
            'methode_tarification' => 'required|in:par_place,par_reservation',  // Add this line for validation
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('app-Services-Services')  // Adjust the route name accordingly
                ->withErrors($validator)
                ->withInput();
        }

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/Service/' . $imageName;
            $image->storeAs('public', $imagePath);  // You can customize the storage path
        }
        $capacite = ($request->input('methode_tarification') == 'par_reservation') ? 1 : $request->input('capacite');
        $dureHours = $request->input('dure_hours') ?? 0;
        $dureMinutes = $request->input('dure_minutes') ?? 0;
        $pause = $request->input('pause') ?? 0;
        $promotion = $request->input('promotion') ? true : false;

        // Create the user
        $user = Service::create([
            'prix' => $request->input('prix'),
            'Designations' => $request->input('Designations'),
            'categories' => $request->input('categories'),
            'image' => $imagePath,  // Save the image path in the database
            'Description' => $request->input('Description'),
            'capacite' => $capacite,  // Set capacite based on methode_tarification
            'dure' => $dureHours,
            'minutes' => $dureMinutes,
            'pause' => $pause,
            'promotion' => $promotion,

            'methode_tarification' => $request->input('methode_tarification'),  // Save the selected method of pricing
        ]);
        // You can add any additional logic you need here, such as sending emails or performing other actions.

        return redirect()->route('app-Services-Services')->with('success', 'services ajouté avec succès.');
    }
}
