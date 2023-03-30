<nav class="nav nav-pills nav-fill">
  <a class="nav-item nav-link {{ ($isOpenCreate || $isOpenCreateTwo) ? 'active' : '' }}" >Patient Info</a>
  <a class="nav-item nav-link {{ ($isOpenCondition || $isOpenConditionTwo) ? 'active' : '' }}" >Add Condition</a>
  <a class="nav-item nav-link {{ ($isOpenHistory) ? 'active' : '' }}" >Patient History</a>
</nav>