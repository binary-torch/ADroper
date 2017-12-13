@component('mail::message')
# Alsalamu Alikum,

The student bellow wants to register in your section with this details:

<br>

---
@component('mail::table')
    | Student's Name | Matric No.    | Course   | Code | Section |
    |:------------- |:------------- |:-------- |:---- |:------- |
    | {{ $application->user->name }} | {{ $application->user->matric_number }} | {{ $application->course->name }} | {{ $application->course->code }} | {{ $application->section->number }} |
@endcomponent

@component('mail::table')
    |  |  |
    | -------------:|:------------- |
    | @component('mail::button', ['url' => url('/application/' . $application->token), 'color' => 'green'])
        Approve Application
    @endcomponent | @component('mail::button', ['url' => url('/application/' . $application->token), 'color' => 'red'])
        Reject Application
    @endcomponent |
@endcomponent

<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent