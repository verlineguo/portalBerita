@extends('admin.layouts.app')
@section('admin_page_title')
    Admin Dashboard
@endsection
@section('content')
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Posts</p>
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
                <div class="card radius-10 border-start border-0 border-4 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Categories</p>
                                <h4 class="my-1 text-danger">{{ $totalCategories }}</h4>
                                <p class="mb-0 font-13">+{{ $newCategoriesPercentage }}% from last week</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto">
                                <i class="bx bxs-category"></i>
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
                                <p class="mb-0 text-secondary">Total Comments</p>
                                <h4 class="my-1 text-success">{{ $totalComments }}</h4>
                                <p class="mb-0 font-13">+{{ $newCommentsPercentage }}% from last week</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                <i class="bx bxs-comment-detail"></i>
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
                                <p class="mb-0 text-secondary">Total Users</p>
                                <h4 class="my-1 text-warning">{{ $totalUsers }}</h4>
                                <p class="mb-0 font-13">+{{ $newUsersPercentage }}% from last week</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto">
                                <i class="bx bxs-group"></i>
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
                                <h6 class="mb-0">Post Activity Overview</h6>
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
                                    style="color: #14abef"></i>Posts</span>
                            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                    style="color: #ffc107"></i>Views</span>
                        </div>
                        <div class="chart-container-1">
                            <canvas id="chart1"></canvas>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
                        <div class="col">
                            <div class="p-3">
                                <h5 class="mb-0">{{ $totalViews }}</h5>
                                <small class="mb-0">Overall Views <span> <i class="bx bx-up-arrow-alt align-middle"></i>
                                        {{ $viewsPercentage }}%</span></small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3">
                                <h5 class="mb-0">{{ $avgTimeOnSite }}</h5>
                                <small class="mb-0">Avg. Time on Site <span> <i
                                            class="bx bx-up-arrow-alt align-middle"></i>
                                        {{ $timeOnSitePercentage }}%</span></small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3">
                                <h5 class="mb-0">{{ $commentsPerPost }}</h5>
                                <small class="mb-0">Comments per Post <span> <i
                                            class="bx bx-up-arrow-alt align-middle"></i>
                                        {{ $commentsPercentage }}%</span></small>
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
                                <h6 class="mb-0">Popular Categories</h6>
                            </div>
                            <div class="dropdown ms-auto">
                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container-2">
                            <canvas id="chart2"></canvas>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($popularCategories as $category)
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

        <div class="card radius-10">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Recent Posts</h6>
                    </div>
                    <div class="dropdown ms-auto">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.post.manage') }}">View all posts</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.post.create') }}">Create new post</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Export data</a></li>
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
                                <th>Author</th>
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
                                    <td>{{ $post->writer->name }}</td>
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
                                            <a href="{{ route('admin.post.show', $post->id) }}"
                                                class="ms-1 text-primary"><i class="bx bxs-edit"></i></a>
                                            <a href="javascript:;" class="ms-2 text-danger"
                                                onclick="if(confirm('Are you sure you want to delete this post?')) document.getElementById('delete-post-{{ $post->id }}').submit();"><i
                                                    class="bx bxs-trash"></i></a>
                                            <form id="delete-post-{{ $post->id }}"
                                                action="{{ route('admin.post.delete', $post->id) }}" method="POST"
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

        <div class="row">
            <div class="col-12 col-lg-7 col-xl-8 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Recent Comments</h6>
                            </div>
                            <div class="dropdown ms-auto">
                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('admin.comment.index') }}">View all
                                            comments</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Export data</a></li>
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
                                                    <span
                                                        class="badge bg-gradient-quepal text-white shadow-sm w-100">Approved</span>
                                                @else
                                                    <span
                                                        class="badge bg-gradient-bloody text-white shadow-sm w-100">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex order-actions">
                                                    <a href="javascript:;" class="ms-1 text-success"
                                                        onclick="if(confirm('Approve this comment?')) document.getElementById('approve-comment-{{ $comment->id }}').submit();"><i
                                                            class="bx bxs-check-circle"></i></a>
                                                    <a href="javascript:;" class="ms-2 text-danger"
                                                        onclick="if(confirm('Are you sure you want to delete this comment?')) document.getElementById('delete-comment-{{ $comment->id }}').submit();"><i
                                                            class="bx bxs-trash"></i></a>
                                                    <!-- Toggle Status -->
                                                    <button
                                                        class="btn btn-sm {{ $comment->status ? 'btn-warning' : 'btn-success' }} toggle-status"
                                                        data-id="{{ $comment->id }}">
                                                        {{ $comment->status ? 'Hide' : 'Show' }}
                                                    </button>

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

            <div class="col-12 col-lg-5 col-xl-4 d-flex">
                <div class="card w-100 radius-10">
                    <div class="card-body">
                        <div class="card radius-10 border shadow-none">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Newsletter Subscribers</p>
                                        <h4 class="my-1">{{ $newsletterCount }}</h4>
                                        <p class="mb-0 font-13">+{{ $newsletterPercentage }}% from last week</p>
                                    </div>
                                    <div class="widgets-icons-2 bg-gradient-cosmic text-white ms-auto"><i
                                            class="bx bxs-envelope"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card radius-10 border shadow-none">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Messages</p>
                                        <h4 class="my-1">{{ $contactCount }}</h4>
                                        <p class="mb-0 font-13">+{{ $contactPercentage }}% from last week</p>
                                    </div>
                                    <div class="widgets-icons-2 bg-gradient-ibiza text-white ms-auto"><i
                                            class="bx bxs-message-detail"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card radius-10 mb-0 border shadow-none">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Active Advertisements</p>
                                        <h4 class="my-1">{{ $adCount }}</h4>
                                        <p class="mb-0 font-13">+{{ $adPercentage }}% from last week</p>
                                    </div>
                                    <div class="widgets-icons-2 bg-gradient-kyoto text-dark ms-auto"><i
                                            class="bx bxs-megaphone"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->

        <div class="row row-cols-1 row-cols-lg-3">
            <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">User Distribution</h6>
                            </div>
                            <div class="dropdown ms-auto">
                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                    data-bs-toggle="dropdown"><i
                                        class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('admin.user.manage') }}">Manage Users</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('admin.user.create') }}">Add New User</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container-0">
                            <canvas id="chart3"></canvas>
                        </div>
                    </div>
                    <div class="row row-group border-top g-0">
                        <div class="col">
                            <div class="p-3 text-center">
                                <h4 class="mb-0 text-danger">{{ $adminCount }}</h4>
                                <p class="mb-0">Admins</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3 text-center">
                                <h4 class="mb-0 text-success">{{ $writerCount }}</h4>
                                <p class="mb-0">Writers</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3 text-center">
                                <h4 class="mb-0 text-primary">{{ $regularCount }}</h4>
                                <p class="mb-0">Regular Users</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Content Status</h6>
                            </div>
                            <div class="dropdown ms-auto">
                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                    data-bs-toggle="dropdown"><i
                                        class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Last 7 days</a>
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Last 30 days</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Current month</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container-1">
                            <canvas id="chart4"></canvas>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li
                            class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                            Published <span class="badge bg-gradient-quepal rounded-pill">{{ $publishedCount }}</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                            Draft <span class="badge bg-gradient-ibiza rounded-pill">{{ $draftCount }}</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                            Pending Comments <span
                                class="badge bg-gradient-deepblue rounded-pill">{{ $pendingCommentCount }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Top Writers</h6>
                            </div>
                            <div class="dropdown ms-auto">
                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                    data-bs-toggle="dropdown"><i
                                        class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item"
                                            href="{{ route('admin.user.manage', ['role' => 1]) }}">View All Writers</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('admin.user.create') }}">Add New
                                            Writer</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Writer</th>
                                        <th>Posts</th>
                                        <th>Comments</th>
                                        <th>Views</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topWriters as $writer)
                                        <tr>
                                            <td>{{ $writer->name }}</td>
                                            <td>{{ $writer->posts_count }}</td>
                                            <td>{{ $writer->total_comments }}</td>
                                            <td>{{ $writer->total_views }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div>
@endsection
@push('scripts-add')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    
    <script>
        
        // Chart initialization script will go here
        $(document).ready(function() {
            // Chart 1 - Post activity overview
            var ctx1 = document.getElementById('chart1').getContext('2d');
            var chart1 = new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: {!! json_encode($activityLabels) !!},
                    datasets: [{
                        label: 'Posts',
                        data: {!! json_encode($postsData) !!},
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
                        label: 'Views',
                        data: {!! json_encode($viewsData) !!},
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

            // Chart 2 - Popular Categories
            var ctx2 = document.getElementById('chart2').getContext('2d');
            var chart2 = new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($categoryNames) !!},
                    datasets: [{
                        data: {!! json_encode($categoryPostCounts) !!},
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

            // Chart 3 - User Distribution
            var ctx3 = document.getElementById('chart3').getContext('2d');
            var chart3 = new Chart(ctx3, {
                type: 'pie',
                data: {
                    labels: ['Admins', 'Writers', 'Regular Users'],
                    datasets: [{
                        data: [{{ $adminCount }}, {{ $writerCount }}, {{ $regularCount }}],
                        backgroundColor: [
                            '#e91e63',
                            '#02ba5a',
                            '#14abef'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            display: true,
                        }
                    }
                }
            });

            // Chart 4 - Content Status
            var ctx4 = document.getElementById('chart4').getContext('2d');
            var chart4 = new Chart(ctx4, {
                type: 'bar',
                data: {
                    labels: ['Published', 'Draft', 'Pending Comments'],
                    datasets: [{
                        label: 'Status',
                        data: [{{ $publishedCount }}, {{ $draftCount }},
                            {{ $pendingCommentCount }}
                        ],
                        backgroundColor: [
                            '#02ba5a',
                            '#14abef',
                            '#5f34b9'
                        ],
                        borderWidth: 1
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
        });
    </script>
@endpush
