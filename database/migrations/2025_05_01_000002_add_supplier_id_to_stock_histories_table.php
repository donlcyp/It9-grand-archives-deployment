<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSupplierIdToStockHistoriesTable extends Migration
{
    public function up()
    {
        Schema::table('stock_histories', function (Blueprint $table) {
            // Add the supplier_id column as nullable and add foreign key constraint
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('stock_histories', function (Blueprint $table) {
            $table->dropForeign(['supplier_id']);
            $table->dropColumn('supplier_id');
        });
    }
}
