@extends('writer.layouts.app')
@section('writer_page_title')
    Writer Dashboard
@endsection
@section('content')
    <div class="page-content">
        <!-- Writer's Personal Stats -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">My Posts</p>
                                <h4 class="my-1 text-info">{{ $totalPosts }}</h4>
                                <p class="mb-0 font-13">+{{ $newPostsPercentage }}% from last week</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto">
                                <i class="bx bxs-news"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Post Views</p>
                                <h4 class="my-1 text-success">{{ $totalViews }}</h4>
                                <p class="mb-0 font-13">+{{ $viewsPercentage }}% from last week</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                <i class="bx bxs-eyedropper"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Comments</p>
                                <h4 class="my-1 text-warning">{{ $totalComments }}</h4>
                                <p class="mb-0 font-13">+{{ $commentsPercentage }}% from last week</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto">
                                <i class="bx bxs-comment-detail"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Draft Posts</p>
                                <h4 class="my-1 text-danger">{{ $draftCount }}</h4>
                                <p class="mb-0 font-13">{{ $draftsMessage }}</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto">
                                <i class="bx bxs-edit"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->

        <div class="row">
            <div class="col-12 col-lg-8 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">My Post Performance</h6>
                            </div>
                            <div class="dropdown ms-auto">
                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Last 7 days</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Last 30 days</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Current month</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center ms-auto font-13 gap-2 mb-3">
                            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                    style="color: #14abef"></i>Views</span>
                            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                    style="color: #ffc107"></i>Comments</span>
                        </div>
                        <div class="chart-container-1">
                            <canvas id="writerChart1"></canvas>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 g-0 row-group text-center border-top">
                        <div class="col">
                            <div class="p-3">
                                <h5 class="mb-0">{{ $avgViewsPerPost }}</h5>
                                <small class="mb-0">Average Views per Post</small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3">
                                <h5 class="mb-0">{{ $avgCommentsPerPost }}</h5>
                                <small class="mb-0">Average Comments per Post</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">My Categories Distribution</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container-2">
                            <canvas id="writerChart2"></canvas>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($myCategories as $category)
                            <li
                                class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                                {{ $category->name }} <span
                                    class="badge bg-success rounded-pill">{{ $category->post_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div><!--end row-->
        
        <!-- Quick Access Buttons -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="mb-0">Quick Actions</h5>
                            </div>
                        </div>
                        <hr/>
                        <div class="row text-center">
                            <div class="col-4">
                                <a href="{{ route('writer.post.create') }}" class="btn btn-primary px-5 radius-30">
                                    <i class="bx bxs-plus-circle mr-1"></i> Create New Post
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="{{ route('writer.post.manage') }}" class="btn btn-outline-danger px-5 radius-30">
                                    <i class="bx bxs-edit mr-1"></i> View My Drafts
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="{{ route('writer.comments') }}" class="btn btn-outline-warning px-5 radius-30">
                                    <i class="bx bxs-comment-detail mr-1"></i> View Recent Comments
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Posts Table -->
        <div class="card radius-10">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">My Recent Posts</h6>
                    </div>
                    <div class="dropdown ms-auto">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('writer.post.manage') }}">View all my posts</a></li>
                            <li><a class="dropdown-item" href="{{ route('writer.post.create') }}">Create new post</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Views</th>
                                <th>Comments</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentPosts as $post)
                                <tr>
                                    <td>{{ Str::limit($post->title, 30) }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>{{ $post->views }}</td>
                                    <td>{{ $post->comments }}</td>
                                    <td>{{ $post->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if ($post->status)
                                            <span
                                                class="badge bg-gradient-quepal text-white shadow-sm w-100">Published</span>
                                        @else
                                            <span class="badge bg-gradient-bloody text-white shadow-sm w-100">Draft</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="{{ route('writer.post.show', $post->id) }}"
                                                class="ms-1 text-primary"><i class="bx bxs-edit"></i></a>
                                            <a href="{{ route('writer.post.preview', $post->id) }}"
                                                class="ms-2 text-info"><i class="bx bxs-show"></i></a>
                                            <a href="javascript:;" class="ms-2 text-danger"
                                                onclick="if(confirm('Are you sure you want to delete this post?')) document.getElementById('delete-post-{{ $post->id }}').submit();"><i
                                                    class="bx bxs-trash"></i></a>
                                            <form id="delete-post-{{ $post->id }}"
                                                action="{{ route('writer.post.delete', $post->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Comments on Writer's Posts -->
        <div class="card radius-10 mt-3">
            <div class="card-header bg-transparent">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Recent Comments on My Posts</h6>
                    </div>
                    <div class="dropdown ms-auto">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('writer.comments') }}">View all comments</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>User</th>
                                <th>Post</th>
                                <th>Comment</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentComments as $comment)
                                <tr>
                                    <td>{{ $comment->user->name }}</td>
                                    <td>{{ Str::limit($comment->post->title, 20) }}</td>
                                    <td>{{ Str::limit($comment->comment, 30) }}</td>
                                    <td>{{ $comment->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if ($comment->status)
                                            <span class="badge bg-gradient-quepal text-white shadow-sm w-100">Approved</span>
                                        @else
                                            <span class="badge bg-gradient-bloody text-white shadow-sm w-100">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="{{ route('writer.post.view', $comment->post->id) }}" class="ms-1 text-info">
                                                <i class="bx bxs-show"></i>
                                            </a>
                                            <a href="{{ route('writer.comments', $comment->id) }}" class="ms-2 text-primary">
                                                <i class="bx bxs-message-rounded-dots"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts-add')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Chart initialization script will go here
        $(document).ready(function() {
            // Chart 1 - Writer's post performance
            var ctx1 = document.getElementById('writerChart1').getContext('2d');
            var chart1 = new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: {!! json_encode($performanceLabels) !!},
                    datasets: [{
                        label: 'Views',
                        data: {!! json_encode($viewsData) !!},
                        backgroundColor: 'rgba(20, 171, 239, 0.1)',
                        borderColor: '#14abef',
                        pointBackgroundColor: '#14abef',
                        pointBorderColor: '#14abef',
                        pointHoverBackgroundColor: '#14abef',
                        pointHoverBorderColor: '#14abef',
                        pointRadius: 3,
                        pointHoverRadius: 4,
                        borderWidth: 2
                    }, {
                        label: 'Comments',
                        data: {!! json_encode($commentsData) !!},
                        backgroundColor: 'rgba(255, 193, 7, 0.1)',
                        borderColor: '#ffc107',
                        pointBackgroundColor: '#ffc107',
                        pointBorderColor: '#ffc107',
                        pointHoverBackgroundColor: '#ffc107',
                        pointHoverBorderColor: '#ffc107',
                        pointRadius: 3,
                        pointHoverRadius: 4,
                        borderWidth: 2
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Chart 2 - Categories distribution
            var ctx2 = document.getElementById('writerChart2').getContext('2d');
            var chart2 = new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($myCategoryNames) !!},
                    datasets: [{
                        data: {!! json_encode($myCategoryPostCounts) !!},
                        backgroundColor: [
                            '#14abef',
                            '#02ba5a',
                            '#d13adf',
                            '#fba540',
                            '#e91e63',
                            '#5f34b9',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            display: false,
                        }
                    }
                }
            });
        });
    </script>
@endpush