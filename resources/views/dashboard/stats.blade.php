@extends('layouts.dashboard')

@section('dashboard_title', 'Statistiques')

@section('dashboard_content')
    <div class="container">
        <h2 class="mb-4">Statistiques des vues de livret</h2>
        <hr>
        <p>Exporter en PDF les statistiques de vues de votre livret</p>
        <button id="exportPdf" class="btn btn-primary">Exporter en PDF</button>
        <hr>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total des vues</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalViews }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">Vues du jour</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $viewsToday }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Vues de la semaine</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $viewsThisWeek }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Vues du mois</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $viewsThisMonth }}</h5>
                    </div>
                </div>
            </div>
        </div>
        @if(isset($viewsBetweenDates))
            <div class="card text-white bg-dark mb-3 mt-3">
                <div class="card-header">Vues entre deux dates</div>
                <div class="card-body">
                    <h5 class="card-title">Du {{ $startDate }} au {{ $endDate }}</h5>
                    <p class="card-text">Nombre de vues : {{ $viewsBetweenDates }}</p>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-3">Vues entre deux dates</h4>
                <form method="get" action="{{ route('dashboard.stats') }}">
                    @csrf
                    @method('get')
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Date de début</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Date de fin</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Voir les statistiques</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
    <script>
        $('#exportPdf').on('click', function() {
            var data = {
                totalViews: $('.card-title:eq(0)').text(),
                viewsToday: $('.card-title:eq(1)').text(),
                viewsThisWeek: $('.card-title:eq(2)').text(),
                viewsThisMonth: $('.card-title:eq(3)').text(),
                viewsBetweenDates: $('.card-text').text(),
                startDate: $('.card-title:eq(4)').text(),
                endDate: $('.card-title:eq(5)').text()
            };

            $.ajax({
                url: '/dashboard/datas/export',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    data: data,
                    type : 'stats'
                }
            }).done(function(response) {
                if (response.status === 'success') {
                    var link = document.createElement('a');
                    link.href = 'data:application/pdf;base64,' + response.pdf_base64;
                    link.download = 'stats.pdf';
                    link.click();
                }
            });
        });
    </script>
@endsection
