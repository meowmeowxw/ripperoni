<div class="align-self-end card bg-transparent text-center col border-0 mx-auto {{$class ?? ''}}" >
    <p><a href="#"><img style="max-height:200px; width:auto; max-width:250px; height:auto;" class="card-img fixed" src="{{$beer->path ?? '-'}}" alt="Card Beer {{$beer->id+1 ?? '0'}}">
        </a></p>
    <div class="card-footer mt-auto">
        <h5 class="card-title">{{$beer->name ?? '-'}}</h5>
        <p class="card-text">sell by <b>{{ \App\Models\Seller::where('id', $beer->seller_id)->first()->company }}</b></p>
        {{--<b>{{ \App\Models\Seller::find($beer->seller_id)->company }}</b>--}}
    </div>
    {{--<div class="card-footer text-muted">
        2 days ago
    </div>--}}
</div>

