@component('mail::message')
# Alsalamu Alikum,
## Dear {{ $application->section->lecturer->name }}

The student bellow wants to register in your section with this details:

<br>

---
@component('mail::table')
    | Student's Name | Matric No.    | Course   | Code | Section |
    |:------------- |:------------- |:-------- |:---- |:------- |
    | {{ $application->user->name }} | {{ $application->user->matric_number }} | {{ $application->course->name }} | {{ $application->course->code }} | {{ $application->section->number }} |
@endcomponent

---

@component('mail::button', ['url' => url('/application/' . $application->token), 'color' => 'blue'])
    Take an Action
@endcomponent

<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent