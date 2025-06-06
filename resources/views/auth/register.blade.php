@extends('layouts.auth')
@section('content')
    <div class="auth-main">
        <div class="auth-wrapper v1">
            <div class="auth-form">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="position-relative my-5">
                    <div class="auth-bg">
                        <span class="r"></span>
                        <span class="r s"></span>
                        <span class="r s"></span>
                        <span class="r"></span>
                    </div>
                    <div class="card mb-0">
                        <div class="card-body">

                            <div class="text-center">
                                <a href="#"><img src="../assets/images/logo-dark.svg" alt="img" /></a>
                            </div>
                            <h4 class="text-center f-w-500 mt-4 mb-3">Sign up</h4>

                            {{-- ✅ MULAI FORM --}}
                            <form method="POST" action="{{ route('auth.register.post') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="text" name="name" class="form-control" placeholder="First Name" required />
                                </div>
                                <div class="form-group mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Email Address" required />
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required />
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required />
                                </div>

                                <div class="d-flex mt-1 justify-content-between">
                                    <div class="form-check">
                                        <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" required />
                                        <label class="form-check-label text-muted" for="customCheckc1">I agree to all the Terms & Condition</label>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary shadow px-sm-4">Sign up</button>
                                </div>
                            </form>
                            {{-- ✅ AKHIR FORM --}}

                            <div class="d-flex justify-content-between align-items-end mt-4">
                                <h6 class="f-w-500 mb-0">Already have an Account?</h6>
                                <a href="{{ route('auth.login') }}" class="link-primary">Login</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
