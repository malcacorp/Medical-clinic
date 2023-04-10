<nav class="nav nav-pills nav-fill">
  <a class="nav-item nav-link {{ ($isOpenCreate || $isOpenCreateTwo) ? 'active' : '' }}" >Patient Info</a>
  <a class="nav-item nav-link {{ ($isOpenCondition) ? 'active' : '' }}" >Nurse Comments</a>
  @can("edit-doctor-comments")
    <a class="nav-item nav-link {{ ($isOpenConditionTwo) ? 'active' : '' }}" >Doctor Comments</a>
  @endcan
  <a class="nav-item nav-link {{ ($isOpenHistories || $isShowHistory) ? 'active' : '' }}" >Patient History</a>
</nav>