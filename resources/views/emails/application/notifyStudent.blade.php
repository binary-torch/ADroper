@component('mail::message')
# Alsalamu Alikum,
## Dear {{ $application->user->name }}

Your application status has been updated:

<br>

---
@component('mail::table')
    | Student's Name | Matric No.    | Course   | Code | Section |
    |:------------- |:------------- |:-------- |:---- |:------- |
    | {{ $application->user->name }} | {{ $application->user->matric_number }} | {{ $application->course->name }} | {{ $application->course->code }} | {{ $application->section->number }} |
@endcomponent
---

@component('mail::button', ['url' => url('/portal'), 'color' => 'green'])
    More Details
@endcomponent

<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent