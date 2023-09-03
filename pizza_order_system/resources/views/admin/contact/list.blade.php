@extends('admin.layouts.master')

@section('title', 'Contact List Page')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Contact List</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class=" offset-10 col-1 bg-white shadow-sm rounded text-center">
                            <h3 class="my-2"><i class="zmdi zmdi-email-open me-2"></i> {{ $contacts->count() }}
                            </h3>
                        </div>
                    </div>

                    <div class="">
                        @if ($contacts->count() != 0)
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Message</th>
                                            <th>Reply</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data-list">
                                        @foreach ($contacts as $contact)
                                            <tr class="tr-shadow">
                                                <td>{{ $contact->id }}</td>
                                                <td>{{ $contact->name }}</td>
                                                <td>{{ $contact->email }}</td>
                                                <td>{{ $contact->message }}</td>
                                                <td>
                                                    <a href=" mailto:{{ $contact->email }}">
                                                        <button class="btn rounded">
                                                            <i class="zmdi zmdi-mail-send"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('contact#delete', $contact->id) }}">
                                                        <button class="btn rounded">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="spacer"></tr>
                                    </tbody>
                                </table>
                                {{-- <div class=" mt-3">
                                {{ $orders->appends(request()->query())->links() }}
                            </div> --}}
                            @else
                            </div>
                            <h3 class="text-secondary text-center mt-5">There is no contact here!</h3>
                            <!-- END DATA TABLE -->
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
