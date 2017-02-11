@if (session('success') || isset($success))
    <div id="success-alert" class="card card-alert card-alert-success">
        <div class="card-content">
            <a href="#!" class="close" data-dismiss="#success-alert">&times;</a>
            <p>{{ isset($success) ? $success : session('success') }}</p>
        </div>
    </div>
@endif

@if (session('warning'))
    <div id="warning-alert" class="card card-alert card-alert-warning">
        <div class="card-content">
            <a href="#!" class="close" data-dismiss="#warning-alert">&times;</a>
            <p>{{ session('warning') }}</p>
        </div>
    </div>
@endif

@if (session('error'))
    <div id="error-alert" class="card card-alert card-alert-error">
        <div class="card-content">
            <a href="#!" class="close" data-dismiss="#error-alert">&times;</a>
            <p>{{ session('error') }}</p>
        </div>
    </div>
@endif

@if (session('information'))
    <div id="information-alert" class="card card-alert card-alert-information">
        <div class="card-content">
            <a href="#!" class="close" data-dismiss="#information-alert">&times;</a>
            <p>{{ session('information') }}</p>
        </div>
    </div>
@endif

@if ( count($errors) )
    <div id="error-alert" class="card card-alert card-alert-error">
        <div class="card-content">
            <a href="#!" class="close" data-dismiss="#error-alert">&times;</a>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif