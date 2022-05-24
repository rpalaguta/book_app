@component('mail::message')
# New Book was created

@component('mail::panel')
    {{ $book->name }}
@endcomponent

@component('mail::button', ['url' => url('book/show', $book->id)])
View Book
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
