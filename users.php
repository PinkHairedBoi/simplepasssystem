<?php
require_once 'header.php';
?>
<script>
  var groupList = [];
  function addUser(name, group_id) {
    if (!name) return;
    $.get("./users/addUser.php", { name: name, group_id: group_id }, function(
      result
    ) {
      if (result) {
        refreshList();
        $("#name").val("");
        $("#group").val("");
      }
    });
  }
  function deleteUser(id) {
    $.get("./users/removeUser.php", { id: id }, function(result) {
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
      <td>${groupList.find(g => g.id == el.group_id).name}</td>
      <td width="30px">
        <a onclick="deleteUser(${el.id})"><i class="far fa-trash-alt"></i></a>
      </td>
    </tr>`;
      $("#list").append(row);
    });
  }
  function clearList() {
    $("#list").empty();
  }
  function refreshList() {
    $.get("./users/getUser.php", function(result) {
      if (result) {
        fillList(eval(result));
      } else {
        clearList();
        $("#list").append("Пока что нет ни одного пользователя");
      }
    });
  }
  function getGroups() {
    $.get("./groups/getGroup.php", function(result) {
      $("groups").empty();
      if (result) {
        groupList = eval(result);
        eval(result).forEach(el => {
          const option = `<option value='${el.id}'>${el.name}</option>`;
          $("#groups").append(option);
        });
      } else {
        $("#name").attr(
          "placeholder",
          "Добавление пользователей без групп невозможно."
        );
        $("#name").attr("disabled", "disabled");
        $("#groups").empty();
      }
      refreshList();
    });
  }
  $(document).ready();
  {
    getGroups();
  }
</script>
<div class="container">
  <div class="columns has-text-centered">
    <div class="column is-8">
      <label class="label">Список пользователей</label>
      <table
        class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth"
        style="margin-top: 20px;"
      >
        <thead>
          <tr>
            <th>Имя</th>
            <th>Группа</th>
          </tr>
        </thead>
        <tbody id="list"></tbody>
      </table>
    </div>
    <div class="column">
      <div class="field">
        <label class="label">Добавить пользователя</label>
        <div class="control">
          <input
            id="name"
            class="input"
            type="text"
            placeholder="Имя пользователя"
          />
        </div>
        <div style="margin-top: 10px;">
          <div class="select">
            <select id="groups"> </select>
          </div>
        </div>
        <a
          style="margin-top: 10px;"
          class="button"
          onclick="addUser($('#name').val(), $('#groups').val())"
          >Добавить</a
        >
      </div>
    </div>
  </div>
</div>
