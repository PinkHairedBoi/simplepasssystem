<?php
require_once 'header.php';
?>
<script>
  function addGroup(name) {
    if (!name) return;
    $.get("./groups/addGroup.php", { name: name }, function(result) {
      if (result) {
        refreshList();
        $("#name").val("");
      }
    });
  }
  function deleteGroup(id) {
    $.get("./groups/removeGroup.php", { id: id }, function(result) {
      if (result) {
        refreshList();
      }
    });
  }
  function fillList(list) {
    clearList();
    list.forEach(el => {
      const row = `
    <tr>
      <td>${el.name}</td>
      <td width="30px">
        <a onclick="deleteGroup(${el.id})"><i class="far fa-trash-alt"></i></a>
      </td>
    </tr>`;
      $("#list").append(row);
    });
  }
  function clearList() {
    $("#list").empty();
  }
  function refreshList() {
    $.get("./groups/getGroup.php", function(result) {
      if (result) {
        fillList(eval(result));
      } else {
        clearList();
        $("#list").append("Пока что нет ни одной группы");
      }
    });
  }

  $(document).ready();
  {
    refreshList();
  }
</script>
<div class="container">
  <div class="columns has-text-centered">
    <div class="column is-8">
      <label class="label">Список групп</label>
      <table
        class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth"
        style="margin-top: 20px;"
      >
        <thead>
          <tr>
            <th>Название</th>
          </tr>
        </thead>
        <tbody id="list"></tbody>
      </table>
    </div>
    <div class="column">
      <div class="field">
        <label class="label">Добавить группу</label>
        <div class="control">
          <input id="name" class="input" type="text" placeholder="Имя группы" />
        </div>
        <a
          style="margin-top: 20px;"
          class="button"
          onclick="addGroup($('#name').val())"
          >Добавить</a
        >
      </div>
    </div>
  </div>
</div>
