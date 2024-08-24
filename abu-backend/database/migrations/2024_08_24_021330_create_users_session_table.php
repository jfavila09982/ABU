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
                Schema::create('session_controller', function (Blueprint $table) {
                $table->id(); // Primary key: id
                $table->string('session_id')->unique(); // Unique session identifier
                $table->string('username'); // Username chosen by the user
                $table->string('ip_address', 45); // IP address of the user (supports IPv4 and IPv6)
                $table->timestamps(); // Created at and Updated at timestamps
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('users_session');
        }
    };
