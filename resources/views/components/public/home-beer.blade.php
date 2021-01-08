<div class="align-self-end card bg-transparent text-center m-2 col border-0 {{$class ?? ''}}" >
    <p><a href="#"><img class="card-img" src="{{$beer->path ?? '-'}}" alt="Card Beer {{$beer->id+1 ?? '0'}}">
        </a></p>
    <div class="card-footer mt-auto">
        <h5 class="card-title">{{$beer->name ?? '-'}}</h5>
        <p class="card-text">sell by -</p>
        {{--<b>{{ \App\Models\Seller::find($beer->seller_id)->company }}</b>--}}
    </div>
    {{--<div class="card-footer text-muted">
        2 days ago
    </div>--}}
</div>

