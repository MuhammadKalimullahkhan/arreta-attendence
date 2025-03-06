<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create("companies", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->timestamps();
        });

        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->unsignedBigInteger('entry_user_id');
            $table->timestamp('entry_date')->useCurrent();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->unsignedBigInteger('entry_user_id');
            $table->timestamp('entry_date')->useCurrent();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('designations', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->unsignedBigInteger('entry_user_id');
            $table->timestamp('entry_date')->useCurrent();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('cnic')->unique();
            $table->string('contact')->nullable();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->foreignId('role_id')->nullable()->constrained('roles')->nullOnDelete();
            $table->foreignId('designation_id')->nullable()->constrained('designations')->nullOnDelete();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->unsignedBigInteger('entry_user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamp('entry_date')->useCurrent();
            $table->timestamp('deleted_at');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->rememberToken();
        });

        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->unsignedBigInteger('entry_user_id');
            $table->boolean('is_active')->default(true);
            $table->timestamp('entry_date')->useCurrent();
            $table->timestamps();
        });

        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('designation_id')->constrained('designations')->cascadeOnDelete();
            $table->integer('year_id');
            $table->integer('month_id');
            $table->date('date');
            $table->boolean('is_present')->default(false);
            $table->foreignId('leave_type_id')->constrained('leave_types');
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->unsignedBigInteger('entry_user_id');
            $table->timestamp('entry_date')->useCurrent();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('designation_id')->constrained('designations')->cascadeOnDelete();
            $table->foreignId('leave_type_id')->constrained('leave_types')->cascadeOnDelete();
            $table->date('from_date');
            $table->integer('number_of_days');
            $table->string('approval')->nullable();
            $table->date('approval_date')->nullable();
            $table->boolean('is_without_pay')->default(false);
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->unsignedBigInteger('entry_user_id');
            $table->timestamp('entry_date')->useCurrent();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('ref_pay_head_types', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->unsignedBigInteger('entry_user_id');
            $table->timestamp('entry_date')->useCurrent();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('ref_pay_heads', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->foreignId('ref_pay_head_type_id')->constrained('ref_pay_head_types')->cascadeOnDelete();
            $table->boolean('is_editable')->default(true);
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->unsignedBigInteger('entry_user_id');
            $table->timestamp('entry_date')->useCurrent();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('employee_salary_setups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('pay_head_id')->constrained('ref_pay_heads')->cascadeOnDelete();
            $table->foreignId('pay_head_type_id')->constrained('ref_pay_head_types')->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->unsignedBigInteger('entry_user_id');
            $table->timestamp('entry_date')->useCurrent();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('employee_salary_setups');
        Schema::dropIfExists('ref_pay_heads');
        Schema::dropIfExists('ref_pay_head_types');
        Schema::dropIfExists('leaves');
        Schema::dropIfExists('leave_types');
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('users');
        Schema::dropIfExists('designations');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('companies');
    }
};
