@extends('layouts.dashboard.layout')
@section('title', trans('messages.books'))

@section('content')
    @include('layouts.dashboard.partials.breadcrumb', ['component' => trans('messages.books')])
    @if (session('success'))
        <script>
            iziToast.success({
                title: trans('messages.success'),
                message: '{{ session('success') }}',
                position: 'topRight'
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            iziToast.error({
                title: trans('messages.error'),
                message: '{{ session('error') }}',
                position: 'topRight'
            });
        </script>
    @endif
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 text-gray-800 mb-0">{{ trans('messages.books') }}</h2>
            <a href="{{ route('books.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>{{ trans('messages.add_book') }}
            </a>
        </div>

        <!-- Main Card -->
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-0 bg-light" placeholder="{{ trans('messages.search_books') }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3 text-muted">#</th>
                                <th class="px-4 py-3 text-muted">{{ trans('messages.title') }}</th>
                                <th class="px-4 py-3 text-muted">{{ trans('messages.author') }}</th>
                                <th class="px-4 py-3 text-muted">{{ trans('messages.publication_year') }}</th>
                                <th class="px-4 py-3 text-muted">{{ trans('messages.description') }}</th>
                                <th class="px-4 py-3 text-muted">{{ trans('messages.subject') }}</th>
                                <th class="px-4 py-3 text-muted">{{ trans('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($books as $book)
                            <tr>
                                <td class="px-4">
                                    <span class="text-primary fw-medium">{{ $book->id }}</span>
                                </td>
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-3">
                                            <img src="{{ asset($book->cover_image) }}" alt="{{ $book->title }}"
                                                class="rounded-circle open-image-modal"
                                                style="width: 40px; height: 40px; object-fit: cover; cursor: pointer;"
                                                data-image-url="{{ asset($book->cover_image) }}">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $book->title ?? trans('messages.na') }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                                        <span>{{ $book->author ?? trans('messages.na') }}</span>
                                    </div>
                                </td>
                                <td><span class="text-muted">{{ $book->publication_year ?? trans('messages.no_book_year') }}</span></td>
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        <span>{{ $book->description ?? trans('messages.no_book_description') }}</span>
                                    </div>
                                </td>
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        <span>{{ $book->subject->name ?? trans('messages.no_book_subject') }}</span>
                                    </div>
                                </td>
                                <td class="px-4">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('books.show', $book->id) }}"
                                            class="btn btn-sm btn-light-primary" data-bs-toggle="tooltip"
                                            title="{{ trans('messages.show_school') }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('books.edit', $book->id) }}"
                                            class="btn btn-sm btn-light-primary" data-bs-toggle="tooltip"
                                            title="{{ trans('messages.edit_school') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-light-danger delete-school-btn"
                                            data-school-id="{{ $book->id }}"
                                            data-school-name="{{ $book->title }}"
                                            title="{{ trans('messages.delete_book') }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">{{ trans('messages.no_books_found') }}</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-0">
                    <img src="" id="modalImage" class="img-fluid" alt="{{ trans('messages.school_logo') }}">
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" id="deleteModalLabel">{{ trans('messages.book_cover_delete_message') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <div class="text-center mb-4">
                        <i class="fas fa-exclamation-circle text-danger fa-3x mb-3"></i>
                        <h5 class="mb-2">{{ trans('messages.book_cover_delete_message') }}</h5>
                        <p class="text-muted mb-0">{{ trans('messages.book_cover_delete_message') }} <span id="schoolNameSpan" class="fw-bold"></span>?</p>
                        <p class="text-muted small mb-0">{{ trans('messages.action_cannot_be_undone') }}.</p>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('messages.cancel') }}</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ trans('messages.delete_book') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .btn-light-primary {
                color: #556ee6;
                background-color: rgba(85, 110, 230, 0.1);
                border-color: transparent;
            }

            .btn-light-primary:hover {
                color: #fff;
                background-color: #556ee6;
            }

            .btn-light-danger {
                color: #f46a6a;
                background-color: rgba(244, 106, 106, 0.1);
                border-color: transparent;
            }

            .btn-light-danger:hover {
                color: #fff;
                background-color: #f46a6a;
            }

            .avatar-sm {
                width: 40px;
                height: 40px;
            }

            .table> :not(caption)>*>* {
                padding: 1rem 0.75rem;
            }

            #imageModal .modal-content {
                background-color: transparent;
                border: none;
            }

            #imageModal .modal-header {
                position: absolute;
                right: 0;
                z-index: 1;
            }

            #imageModal .btn-close {
                background-color: white;
                opacity: 0.8;
                border-radius: 50%;
                padding: 0.5rem;
                margin: 0.5rem;
            }

            #imageModal .btn-close:hover {
                opacity: 1;
            }

            .open-image-modal {
                transition: transform 0.2s ease;
            }

            .open-image-modal:hover {
                transform: scale(1.1);
            }

            #modalImage {
                max-height: 80vh;
                object-fit: contain;
            }

            #deleteModal .modal-content {
                border: none;
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            }
        </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image Modal Functionality
            const images = document.querySelectorAll('.open-image-modal');
            const modalImage = document.getElementById('modalImage');
            const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));

            images.forEach(image => {
                image.addEventListener('click', function() {
                    const imageUrl = this.getAttribute('data-image-url');
                    modalImage.src = imageUrl;
                    modalImage.alt = this.alt;
                    imageModal.show();
                });
            });

            // Delete Modal Functionality
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const deleteButtons = document.querySelectorAll('.delete-school-btn');
            const deleteForm = document.getElementById('deleteForm');
            const schoolNameSpan = document.getElementById('schoolNameSpan');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const schoolId = this.getAttribute('data-school-id');
                    const schoolName = this.getAttribute('data-school-name');
                    
                    deleteForm.action = `{{ route('books.destroy', '') }}/${schoolId}`;
                    schoolNameSpan.textContent = schoolName;
                    deleteModal.show();
                });
            });
        });
    </script>
    @endpush
@endsection