<div class="card sticky-action brown lighten-5">
    <div class="card-image waves-effect waves-block waves-light">
        <img class="activator" src="{{ asset($foto) }}" alt="{{ $nome }}">
    </div>
    <div class="card-content">
        <span class="card-title activator grey-text text-darken-4 nome">
            {{ $nome }}
            <i class="material-icons right">more_vert</i>
        </span>
    </div>

    <div class="card-reveal">
        <span class="card-title">
            <i class="material-icons right">close</i>
        </span>
        <span class="card-title grey-text text-darken-4 nome">
            <h2>{{ $nome }}</h2>
        </span>
        <p class="light descricao">{{ $curriculo }}</p>
    </div>
</div>