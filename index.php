<?php
require_once 'header.php';
?>
<script>
  var groupList = [];
  var userList = [];
  function enter() {
    $.get("./entries/addEntry.php", { direction: true }, function(result) {
      if (result) {
        refreshList();
      }
    });
  }
  function exit() {
    $.get("./entries/addEntry.php", { direction: false }, function(result) {
      if (result) {
        refreshList();
      }
    });
  }
  function deleteEntry(id) {
    $.get("./entries/removeEntry.php", { id: id }, function(result) {
      if (result) {
        refreshList();
      }
    });
  }
  function fillList(list) {
    clearList();
    list.forEach(el => {
      const u = userList.find(u => u.id == el.user_id);
      const row = `
    <tr>
      <td>${groupList.find(g => g.id == u.group_id).name}</td>
      <td>${u.name}</td>
      <td>${el.date_in}</td>
      <td>${el.date_out || "Ещё не вышел"}</td>
      <td width="30px">
        <a onclick="deleteEntry(${el.id})"><i class="far fa-trash-alt"></i></a>
      </td>
    </tr>`;
      $("#list").append(row);
    });
  }
  function clearList() {
    $("#list").empty();
  }
  function refreshList() {
    $.get("./entries/getEntry.php", function(result) {
      if (result) {
        fillList(eval(result));
      } else {
        clearList();
        $("#list").append("Пока что нет ни одной записи");
      }
    });
  }
  function getUsers() {
    $.get("./users/getUser.php", function(result) {
      if (result) {
        userList = eval(result);
      }
      refreshList();
    });
  }
  function getGroups() {
    $.get("./groups/getGroup.php", function(result) {
      if (result) {
        groupList = eval(result);
      }
      getUsers();
    });
  }
  $(document).ready();
  {
    getGroups();
  }
</script>
<div class="container">
  <div class="column has-text-centered">
    <button onclick="enter()" class="button">Имитировать вход</button>
    <button onclick="exit()" class="button">Имитировать выход</button>
    <div class="column">
      <label class="label">Список посещений</label>
      <table
        class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth"
        style="margin-top: 20px;"
      >
        <thead>
          <tr>
            <th>Группа</th>
            <th>Имя</th>
            <th>Время входа</th>
            <th>Время выхода</th>
          </tr>
        </thead>
        <tbody id="list"></tbody>
      </table>
    </div>
  </div>
</div>
