<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up() {
Schema::create('departments', function (Blueprint $table) {
$table->id();
$table->string('description');
$table->unsignedBigInteger('CompanyID');
$table->unsignedBigInteger('EntryUserID');
$table->timestamp('EntryDate')->useCurrent();
$table->boolean('IsActive')->default(true);
$table->timestamps();
});

Schema::create('roles', function (Blueprint $table) {
$table->id();
$table->string('description');
$table->unsignedBigInteger('CompanyID');
$table->unsignedBigInteger('EntryUserID');
$table->timestamp('EntryDate')->useCurrent();
$table->boolean('IsActive')->default(true);
$table->timestamps();
});

Schema::create('designations', function (Blueprint $table) {
$table->id();
$table->string('description');
$table->unsignedBigInteger('CompanyID');
$table->unsignedBigInteger('EntryUserID');
$table->timestamp('EntryDate')->useCurrent();
$table->boolean('IsActive')->default(true);
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
    $table->foreignId('departmentId')->nullable()->constrained('departments')->nullOnDelete();
    $table->foreignId('roleId')->nullable()->constrained('roles')->nullOnDelete();
    $table->foreignId('designationId')->nullable()->constrained('designations')->nullOnDelete();
    $table->unsignedBigInteger('CompanyID');
    $table->unsignedBigInteger('EntryUserID');
    $table->timestamp('EntryDate')->useCurrent();
    $table->boolean('IsActive')->default(true);
    $table->timestamps();
    $table->rememberToken();
});

Schema::create('attendances', function (Blueprint $table) {
$table->id();
$table->foreignId('employeeId')->constrained('users')->cascadeOnDelete();
$table->foreignId('designationId')->constrained('designations')->cascadeOnDelete();
$table->integer('yearId');
$table->integer('monthId');
$table->date('date');
$table->string('status')->nullable();
$table->boolean('isPresent')->default(false);
$table->unsignedBigInteger('CompanyID');
$table->unsignedBigInteger('EntryUserID');
$table->timestamp('EntryDate')->useCurrent();
$table->boolean('IsActive')->default(true);
$table->timestamps();
});

Schema::create('leaves', function (Blueprint $table) {
$table->id();
$table->foreignId('employeeId')->constrained('users')->cascadeOnDelete();
$table->foreignId('designationId')->constrained('designations')->cascadeOnDelete();
$table->integer('leaveTypeId');
$table->date('fromDate');
$table->integer('numberOfDays');
$table->string('approval')->nullable();
$table->date('approvalDate')->nullable();
$table->boolean('isWithoutPay')->default(false);
$table->unsignedBigInteger('CompanyID');
$table->unsignedBigInteger('EntryUserID');
$table->timestamp('EntryDate')->useCurrent();
$table->boolean('IsActive')->default(true);
$table->timestamps();
});

Schema::create('employee_salary_setups', function (Blueprint $table) {
$table->id();
$table->foreignId('EmpID')->constrained('users')->cascadeOnDelete();
$table->unsignedBigInteger('PayHeadID');
$table->decimal('Amount', 10, 2);
$table->unsignedBigInteger('CompanyID');
$table->unsignedBigInteger('EntryUserID');
$table->timestamp('EntryDate')->useCurrent();
$table->boolean('IsActive')->default(true);
$table->timestamps();
});

Schema::create('ref_pay_heads', function (Blueprint $table) {
$table->id();
$table->string('Description');
$table->unsignedBigInteger('TypeID');
$table->boolean('IsEditable')->default(true);
$table->unsignedBigInteger('CompanyID');
$table->unsignedBigInteger('EntryUserID');
$table->timestamp('EntryDate')->useCurrent();
$table->boolean('IsActive')->default(true);
$table->timestamps();
});

Schema::create('ref_pay_head_types', function (Blueprint $table) {
$table->id();
$table->string('Description');
$table->unsignedBigInteger('CompanyID');
$table->unsignedBigInteger('EntryUserID');
$table->timestamp('EntryDate')->useCurrent();
$table->boolean('IsActive')->default(true);
$table->timestamps();
});
}

public function down() {
Schema::dropIfExists('ref_pay_head_types');
Schema::dropIfExists('ref_pay_heads');
Schema::dropIfExists('employee_salary_setups');
Schema::dropIfExists('leaves');
Schema::dropIfExists('attendances');
Schema::dropIfExists('users');
Schema::dropIfExists('designations');
Schema::dropIfExists('roles');
Schema::dropIfExists('departments');
}
};
