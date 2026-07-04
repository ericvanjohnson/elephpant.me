<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RemovePrototypeElephpants extends Migration
{
    /**
     * Prototype species that should not appear in the catalog or collections.
     *
     * @var list<int>
     */
    private const PROTOTYPE_ELEPHPANT_IDS = [55, 62, 53, 52];

    /**
     * Remove prototype elephpants from all herds, then delete the records.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function (): void {
            DB::table('elephpant_user')
                ->whereIn('elephpant_id', self::PROTOTYPE_ELEPHPANT_IDS)
                ->delete();

            DB::table('elephpants')
                ->whereIn('id', self::PROTOTYPE_ELEPHPANT_IDS)
                ->delete();
        });
    }

    /**
     * Reversal is not possible without a database backup.
     *
     * @return void
     */
    public function down()
    {
    }
}
