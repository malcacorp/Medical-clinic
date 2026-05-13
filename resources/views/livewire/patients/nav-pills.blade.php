<nav class="nav nav-pills nav-fill">
  <a class="nav-item nav-link {{ ($isOpenCreate || $isOpenCreateTwo) ? 'active' : '' }}" >{{ __('Patient Information') }}</a>
  <a class="nav-item nav-link {{ ($isOpenCondition) ? 'active' : '' }}" >{{ __('Nurse Comments') }}</a>
  @can("edit-doctor-comments")
    <a class="nav-item nav-link {{ ($isOpenGynecology) ? 'active' : '' }}" >{{ __('Gynecology') }}</a>
    <a class="nav-item nav-link {{ ($isOpenPediatrics) ? 'active' : '' }}" >{{ __('Pediatrics') }}</a>
    <a class="nav-item nav-link {{ ($isOpenConditionTwo) ? 'active' : '' }}" >{{ __('Doctor Comments') }}</a>
  @endcan
  <a class="nav-item nav-link {{ ($isOpenHistories || $isShowHistory) ? 'active' : '' }}" >{{ __('Patient History') }}</a>
</nav>