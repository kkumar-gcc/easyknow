<div >
    <div class="e-card">
        <div class="card-body">
            <ul class="nav nav-tabs" role="tablist"  id="details">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $subTab == 'comments' ? 'active' : '' }}"
                        href="/users/{{ $user->id }}/{{ $user->username }}/public?tab=activity&subtab=comments"
                        role="tab">comments</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $subTab == 'tags' ? 'active' : '' }}"
                        href="/users/{{ $user->id }}/{{ $user->username }}/public?tab=activity&subtab=tags"
                        role="tab">tags ({{ nice_number($user->blogs->where('status','=','posted')->count()) }})</a>
                </li>
            
            </ul>
        </div>
    </div>
</div>
