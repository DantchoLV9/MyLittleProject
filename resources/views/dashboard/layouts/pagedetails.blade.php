@section('pagedetails')

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
          <h2 class="col-xl-6 col-lg-6 col-md-6 col-12">@yield('pagetitle')</h2>
          <nav class="col-xl-6 col-lg-6 col-md-6 col-12" aria-label="breadcrumb">
            <ol class="breadcrumb dashboard-breadcrumb">
              @php
              
                $url = Request::path();
                $urlElements = explode ("/", $url);
                $arraySize = count ($urlElements);

              @endphp
              @foreach ($urlElements as $breadCrumbElement)

                @if ($loop->iteration == $arraySize)
                  <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($breadCrumbElement) }}</li>
                @else
                  <li class="breadcrumb-item">{{ ucfirst($breadCrumbElement) }}</li>
                @endif 

              @endforeach
            </ol>
          </nav>
        </div>
        
@endsection