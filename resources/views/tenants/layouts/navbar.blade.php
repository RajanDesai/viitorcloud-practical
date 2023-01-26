@php
    $authUser = auth()->user();
@endphp
<ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
    <li class="nav-item">
        <a href="{{ route('tenants.home', $authUser->slug) }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item dropdown">
        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">{{ $authUser->name }}</a>
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
          <li><a href="{{ route('tenants.profile', $authUser->slug) }}" class="dropdown-item">Edit Profile </a></li>
          <li><a href="{{ route('tenants.logout', $authUser->slug) }}" class="dropdown-item">Logout</a></li>
        </ul>
      </li>
  </ul>