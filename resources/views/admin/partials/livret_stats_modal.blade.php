@php
    use App\Models\LivretView;

    $totalViews = LivretView::where('livret_id', $livret->id)->count();

    $viewsThisWeek = LivretView::where('livret_id', $livret->id)
        ->whereBetween('viewed_at', [now()->startOfWeek(), now()->endOfWeek()])
        ->count();

    $viewsToday = LivretView::where('livret_id', $livret->id)
        ->whereDate('viewed_at', today())
        ->count();

    $viewsThisMonth = LivretView::where('livret_id', $livret->id)
        ->whereBetween('viewed_at', [now()->startOfMonth(), now()->endOfMonth()])
        ->count();
@endphp
<div class="modal fade" id="statsModal_{{$livret->id}}" tabindex="-1" aria-labelledby="statsModalModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statsModalModalLabel">Statistiques du livret - {{$livret->livret_name}}</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
