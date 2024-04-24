<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Staudenmeir\LaravelMergedRelations\Facades\Schema;

use App\Models\Barbecue;

return new class extends Migration
{
    public function up(): void
    {
        Schema::createOrReplaceMergeView(
            'barbecues_friendships_view',
            [(new Barbecue())->acceptedInvitations(), (new Barbecue())->acceptedRequests(), (new Barbecue())->owner()],
            true
        );
    }

    public function down(): void
    {
    }
};
