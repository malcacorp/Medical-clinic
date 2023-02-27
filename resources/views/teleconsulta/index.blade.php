@extends('template')


@section('content')
<div id="App">



</div>


@endsection

@section('css')
<script>

    window.user = {

        id : {{ auth()->id() }} ,
        name: "{{ auth()->user()->nombres }}"

    };
    window.csrfToken={{  csrf_token() }};
</script>
@endsection