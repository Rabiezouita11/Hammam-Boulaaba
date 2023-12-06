    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('reservations', function (Blueprint $table) {
                $table->id(); // Auto-incrementing primary key
                $table->unsignedBigInteger('user_id'); // Foreign key to link with user table
                $table->enum('etat_confirmation', ['confirmer', 'En attente','refuser']);
                $table->enum('etat_paiement', ['payé','impayé']);
                $table->enum('type_reservation', ['sur place', 'En ligne']);
                $table->timestamps(); // Created_at and updated_at timestamps
                // Define foreign key constraints
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('reservations');
        }
    };
