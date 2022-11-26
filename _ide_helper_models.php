<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Appointment
 *
 * @property int $id
 * @property int $clinic_id
 * @property int $doctor_id
 * @property int $patient_id
 * @property int $schedule_id
 * @property string $start_time
 * @property string $end_time
 * @property array $service
 * @property string|null $description
 * @property string $payment_option
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Clinic|null $clinic
 * @property-read \App\Models\User|null $doctors
 * @property-read \App\Models\Patient|null $patient
 * @property-read \App\Models\User|null $patients
 * @property-read \App\Models\Schedule|null $schedule
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereClinicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment wherePaymentOption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appointment whereUpdatedAt($value)
 */
	class Appointment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Clinic
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $contact
 * @property int $status
 * @property string $address
 * @property string $country
 * @property string $city
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array $specialization_id
 * @property string $image
 * @property mixed $specialization
 * @property-read \App\Models\User|null $users
 * @method static \Illuminate\Database\Eloquent\Builder|Clinic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Clinic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Clinic query()
 * @method static \Illuminate\Database\Eloquent\Builder|Clinic whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clinic whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clinic whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clinic whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clinic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clinic whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clinic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clinic whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clinic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clinic whereSpecializationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clinic whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clinic whereUpdatedAt($value)
 */
	class Clinic extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Doctor
 *
 * @property int $id
 * @property string $fname
 * @property string $lname
 * @property string $contact
 * @property string $dob
 * @property string $experience
 * @property string $gender
 * @property string|null $address
 * @property string|null $country
 * @property string|null $city
 * @property int $status
 * @property string|null $image
 * @property string|null $password
 * @property string|null $email_verified_at
 * @property int $is_admin
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Clinic|null $clinic
 * @property-read mixed $full_name
 * @property-read \App\Models\Specialization|null $specialty
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereFname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Doctor whereUpdatedAt($value)
 */
	class Doctor extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Patient
 *
 * @property int $id
 * @property string $fname
 * @property string $lname
 * @property string $email
 * @property int $clinic_id
 * @property string $contact
 * @property string $dob
 * @property string $specialization
 * @property string $experience
 * @property string $gender
 * @property string $address
 * @property string $country
 * @property string $city
 * @property int $status
 * @property string $password
 * @property string|null $email_verified_at
 * @property int $is_admin
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Clinic $clinic
 * @property-read mixed $full_name
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereClinicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereFname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereSpecialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereUpdatedAt($value)
 */
	class Patient extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Prescription
 *
 * @property int $id
 * @property int $clinic_id
 * @property int $doctor_id
 * @property int $patient_id
 * @property string $date
 * @property string $medicine_name
 * @property string $frequency
 * @property string $duration
 * @property string|null $instruction
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Clinic $clinic
 * @property-read \App\Models\User $doctors
 * @property-read \App\Models\User $patients
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription query()
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereClinicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereInstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereMedicineName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereUpdatedAt($value)
 */
	class Prescription extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Receptionist
 *
 * @property int $id
 * @property string $fname
 * @property string $lname
 * @property string $email
 * @property int $clinic_id
 * @property string $contact
 * @property string $dob
 * @property string $gender
 * @property string $address
 * @property string $country
 * @property string $city
 * @property int $status
 * @property string|null $password
 * @property string|null $email_verified_at
 * @property int $is_admin
 * @property string|null $image
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Clinic $clinic
 * @property-read mixed $full_name
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist query()
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist whereClinicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist whereFname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist whereLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receptionist whereUpdatedAt($value)
 */
	class Receptionist extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ReviewRating
 *
 * @property int $id
 * @property int $patient_id
 * @property int $doctor_id
 * @property int $appointment_id
 * @property string|null $comments
 * @property int $star_rating
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Appointment|null $appointment
 * @property-read \App\Models\User $patients
 * @method static \Illuminate\Database\Eloquent\Builder|ReviewRating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReviewRating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReviewRating query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReviewRating whereAppointmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReviewRating whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReviewRating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReviewRating whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReviewRating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReviewRating wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReviewRating whereStarRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReviewRating whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReviewRating whereUpdatedAt($value)
 */
	class ReviewRating extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Schedule
 *
 * @property int $id
 * @property int $clinic_id
 * @property int $doctor_id
 * @property string $day
 * @property string $start_time
 * @property string $end_time
 * @property string $duration
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Clinic $clinic
 * @property-read \App\Models\User $doctors
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereClinicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereUpdatedAt($value)
 */
	class Schedule extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServiceCategory
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereUpdatedAt($value)
 */
	class ServiceCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Services
 *
 * @property int $id
 * @property int $service_cid
 * @property string $name
 * @property string $charges
 * @property int $doctor_id
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $doctors
 * @property-read \App\Models\ServiceCategory $service_category
 * @method static \Illuminate\Database\Eloquent\Builder|Services newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Services newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Services query()
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereCharges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereServiceCid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Services whereUpdatedAt($value)
 */
	class Services extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $footer
 * @property string $email
 * @property string $logo
 * @property string $favicon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $contact
 * @property string|null $fb
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFavicon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereFooter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Specialization
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization query()
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Specialization whereUpdatedAt($value)
 */
	class Specialization extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property int $appointment_id
 * @property string $reference_no
 * @property string $clinic_id
 * @property string $doctor_id
 * @property string $patient_id
 * @property string $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAppointmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereClinicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereReferenceNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 */
	class Transaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Treated
 *
 * @property int $id
 * @property int $app_id
 * @property string|null $problem
 * @property string|null $teeth
 * @property string|null $fee
 * @property string|null $remarks
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $status
 * @property string|null $name
 * @property string|null $file_path
 * @property-read \App\Models\Appointment $appointment
 * @method static \Illuminate\Database\Eloquent\Builder|Treated newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Treated newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Treated query()
 * @method static \Illuminate\Database\Eloquent\Builder|Treated whereAppId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treated whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treated whereFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treated whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treated whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treated whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treated whereProblem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treated whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treated whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treated whereTeeth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treated whereUpdatedAt($value)
 */
	class Treated extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $fname
 * @property string $lname
 * @property string $email
 * @property int|null $clinic_id
 * @property string $contact
 * @property string $dob
 * @property string|null $specialization_id
 * @property string|null $experience
 * @property string $gender
 * @property string|null $address
 * @property string|null $country
 * @property string|null $city
 * @property string|null $image
 * @property int $status
 * @property string|null $password
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property int $type
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $isClinicAdmin
 * @property-read \App\Models\Clinic|null $clinic
 * @property-read mixed $full_name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Services[] $service
 * @property-read int|null $service_count
 * @property-read \App\Models\Specialization|null $specialty
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereClinicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsClinicAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSpecializationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

