@if ( count($errors) )
    <div id="card-alert" class="card red lighten-5">
        <div class="card-content red-text text-darken-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li><strong>{{ $error }}</strong></li>
                @endforeach
            </ul>
        </div>
    </div>
@endif