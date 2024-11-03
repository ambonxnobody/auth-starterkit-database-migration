<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
            $table->foreignIdFor(User::class, 'owner_id')->constrained('users')->cascadeOnDelete();
            // folder_id is nullable because it can be a root folder
            $table->string('name');
            $table->string('path');
            $table->unsignedBigInteger('size')->default(0);
            $table->string('type')->default('file')->comment('document, spreadsheet, presentation, form, image, pdf, video, shortcut, site, audio, drawing, archive, file');
            $table->string('access')->default('viewer')->comment('viewer, editor, owner');
            $table->string('bucket_name');
            $table->boolean('is_public')->default(false);
            $table->jsonb('file_metadata')->nullable();
            $table->jsonb('metadata')->default(json_encode([
                'created_at' => null,
                'created_by' => null,
                'updated_at' => null,
                'updated_by' => null,
                'deleted_at' => null,
                'deleted_by' => null
            ]));
        });

        DB::statement("
        CREATE TRIGGER set_created_at_jsonb_timestamps
        BEFORE INSERT ON assets
        FOR EACH ROW EXECUTE FUNCTION update_created_at_jsonb_timestamps();
        ");

        DB::statement("
        CREATE TRIGGER set_updated_at_jsonb_timestamps
        BEFORE UPDATE ON assets
        FOR EACH ROW EXECUTE FUNCTION update_updated_at_jsonb_timestamps();
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
        DB::statement('DROP TRIGGER IF EXISTS set_created_at_jsonb_timestamps ON assets;');
        DB::statement('DROP TRIGGER IF EXISTS set_updated_at_jsonb_timestamps ON assets;');
    }
};
