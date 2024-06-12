<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Kost Griya Kenyo</title>
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script>
    $(function() {
      $("#datepicker").datepicker({
        dateFormat: 'dd-mm-yy'
      }).val();
      // $( "#datepicker").datepicker("show");
    })
  </script>
  @include('includes.main.style')
  @include('includes.main.styledetail')
</head>

<body>
  @include('includes.main.navbar')
  <main class="site-main">
    <div class="page-content page-details">
      <section class="kost-breadcrumbs">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                  </li>
                  <li class="breadcrumb-item active">
                    Kost Details
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>

      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif

      <section class="store-gallery mb-3" id="gallery">
        <div class="container">
          <div class="row">
            @php $incrementRoomType = 0 @endphp
            @forelse ($room_types as $room_type)
            <div class="col-lg-8" data-aos="zoom-in">
              <transition name="slide-fade" mode="out-in">
                <img src="{{ Storage::url($room_type->photo) }}"
                :src="photos[activePhoto].url"
                        :key="photos[activePhoto].id"
                        alt="" style="width: 70%" />
              </transition>
            </div>
            @empty
            <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
              Tipe Kamar Tidak Ditemukan
            </div>
            @endforelse
            <div class="col-lg-4" data-aos="zoom-in">
                <div class="card-body shadow-lg p-3 mb-5 bg-white rounde">
                    <form action="{{ route('booking',$room_type->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input name="booking_validation" type="hidden" value="0">
                    <div class="form-group">
                        <label for="date">Pilih tanggal masuk</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                                <input type="date" class="form-control" id="datepicker" name="arrival_date" placeholder="DD/MM/YYYY">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="duration">Durasi Sewa</label>
                        <select name="duration" id="duration" class="form-control">
                            <option value="1">1 Bulan</option>
                            <option value="6">6 Bulan</option>
                            <option value="12">1 Tahun</option>
                        </select>
                    </div>
                    <br>
                    <br>
                    @auth
                    <button type="submit" class="btn btn-success px-5 text-white btn-block mb-3">
                        Pesan Kamar
                    </button>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-success px-4 text-white btn-block mb-3">
                        Masuk Untuk Pesan
                    </a>
                    @endauth
                </form>
                </div>
            </div>
        </div>
        </div>
    </section>
    <div class="store-details-container" data-aos="fade-up">
        <section class="store-heading">
            <div class="container">
            <div class="row">
                @php
                $incrementRoomTypes = 0
                @endphp
                @forelse ($room_types as $room_type)
                <div class="col-lg-8">
                    <h1>Tipe Kamar</h1>
                    <input type="hidden" name="id" value="{{ $room_type->room }}">
                    <div class="owner">{{ $room_type->name }}</div>
                    <div class="price">Rp {{ number_format($room_type->price) }} / Per Bulan</div>
                </div>
                @empty
                <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                    Tipe Kamar Tidak Ditemukan
                </div>
                @endforelse
            </div>
            <div class="row">
                @php $incrementRoomType = 0 @endphp
                <div class="col-md-6">
                    <h4>Fasilitas</h4>
                    <p>Fasilitas yang tersedia pada kamar ini</p>
                    @forelse ($room_type->facilities as $facility)
                    <div class="card-body">
                        <ul>
                            <p>-> {{ $facility->name }}</p>
                        </ul>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                        Data Fasilitas Tidak Ditemukan
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    </section>
    </div>
    </div>
</main>

<script>
    $('#exampleModal').on('show.bs.modal', event => {
    var button = $(event.relatedTarget);
    var modal = $(this);
    });
</script>



@include('includes.main.footer')


@include('includes.main.script')
@push('addon-script')
<script src="{{ url('/vue/vue.js') }}"></script>
<script src="{{ url('/js/moment.min.js') }}"></script>
@endpush

</body>

</html>
