@extends('layouts.user_type.guest')

@section('content')

  <section class="min-vh-100 mb-8">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 mx-3 border-radius-lg" style="background-image: url('../assets/img/baby1.jpg');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">Hai!</h1>
            <p class="text-lead text-white">Silahkan daftarkan bayi Anda disini :)</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              <h5>Daftar</h5>
            </div>
            <div class="card-body pt-0">
              <form role="form text-left" method="POST" action="/register">
                @csrf
                <div class="mb-2">
                <label for="baby_birthdate">Nama Bayi</label>
                  <input type="text" class="form-control" placeholder="Nama Bayi" name="baby_name" id="baby_name" aria-label="Baby Name" aria-describedby="baby_name" value="{{ old('baby_name') }}">
                  @error('baby_name')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
                <div class="mb-2">
                  <label for="baby_birthdate">Tanggal Lahir</label>
                  <input type="date" class="form-control" placeholder="Tanggal Lahir" name="baby_birthdate" id="baby_birthdate" aria-label="Baby Birth Date" aria-describedby="baby_birthdate" value="{{ old('baby_birthdate') }}">
                  @error('baby_birthdate')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
                <div class="mb-2">
                    <label for="baby_birthdate">Nama Ibu</label>
                    <input type="text" class="form-control" placeholder="Nama Ibu" name="mother_name" id="mother_name" aria-label="Mother Name" aria-describedby="mother_name" value="{{ old('mother_name') }}">
                    @error('mother_name')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="baby_birthdate">Email</label>
                    <input type="email" class="form-control" placeholder="Email" name="email" id="email" aria-label="Email" aria-describedby="email-addon" value="{{ old('email') }}">
                    @error('email')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
                <div class="mb-3">
                    <label for="baby_birthdate">Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" aria-label="Password" aria-describedby="password-addon">
                    @error('password')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-check form-check-info text-left">
                  <input class="form-check-input" type="checkbox" name="agreement" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    Saya setuju dengan <a href="javascript:;" class="text-dark font-weight-bolder">Syarat dan Ketentuan</a>
                  </label>
                  @error('agreement')
                    <p class="text-danger text-xs mt-2">Setujui terlebih dahulu Syarat dan Ketentuan, kemudian coba untuk daftar kembali.</p>
                  @enderror
                </div>
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Daftar</button>
                </div>
                <p class="text-sm mt-3 mb-0">Sudah memiliki akun? <a href="login" class="text-dark font-weight-bolder">Masuk</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

