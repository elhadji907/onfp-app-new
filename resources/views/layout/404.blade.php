@extends('layout.default')

@section('content')

    <!-- Page Wrapper -->

    <div class="container-fluid">

        <!-- 404 Error Text -->
        <div class="text-center">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-5">Page non trouvée</p>
            <p class="text-gray-500 mb-0">
                {{("Il semble que vous ayez rencontré un problème veuillez contacter l' ")}}<a href="mailto:lamine.badji@onfp.sn">administrateur</a></p>
            <a href="{{ url('/') }}">&larr; {{ "Retour à la page d'accueil" }}</a>
        </div>

    </div>

@endsection
