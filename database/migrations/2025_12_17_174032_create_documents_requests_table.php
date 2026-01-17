<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents_requests', function (Blueprint $table) {
            $table->id();
             Schema::table('documents_requests', function (Blueprint $table) {
        $table->string('card_type')->nullable();
    });
    Schema::table('documents_requests', function (Blueprint $table) {
            $table->string('applicant_type')->default('person')->after('type');
        });
        Schema::table('documents_requests', function (Blueprint $table) {
            $table->string('owner_type')->default('person')->after('applicant_type');
        });

            // صاحب الملكية
           $table->string('owner_nin');
            $table->string('owner_lastname')->nullable();
              $table->string('owner_firstname'); 
            $table->string('owner_father')->nullable();
            $table->date('owner_birthdate')->nullable(); 
            $table->string('owner_birthplace')->nullable();

            // مقدم الطلب
            $table->string('applicant_nin');
            $table->string('applicant_lastname')->nullable();
            $table->string('applicant_firstname');
            $table->string('applicant_father')->nullable();
           $table->string('applicant_email');
          $table->string('applicant_phone');

          //حالة العقار 
        $table->string ('property_status');
         $table->string ('section');
         $table->string  ('municipality');
         $table->string ('plan_number');
         $table->string ('parcel_number');
         $table->string ( 'municipality_ns');
         $table->string ('subdivision_number');
         $table->string ('parcel_number_ns');
            // التواصل
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            // التعريفات
            $table->string('nin')->nullable();
            $table->string('nif')->nullable();

            // نوع 
       
            $table->string('card_type');
            $table->string('type')->default('personal');       // personal / corporate
            $table->string('status')->default('pending');      // pending / approved / rejected / extracted
           $table->string('applicant_type' ); 
           $table->string('owner_type' ); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents_requests');
 Schema::table('documents_requests', function (Blueprint $table) {
        $table->dropColumn('card_type');
        $table->dropColumn('property_status');
    });
     Schema::table('documents_requests', function (Blueprint $table) {
            $table->dropColumn('applicant_type');
        });
        Schema::table('documents_requests', function (Blueprint $table) {
            $table->dropColumn('owner_type');
        });
    }
   
  
};




