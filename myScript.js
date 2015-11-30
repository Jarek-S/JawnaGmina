$(function () {
    var $contentBox = $("#mainContainer"),
        $linkButton = $("#getLinks"),
        $searchFormButton = $("#showSearchForm"),
        $searchForm = $("#searchForm");

    function showLinks(links) {
        $contentBox.html(
            '<div id="result" class="panel panel-success">' +
            '<div class="panel-heading"><h3 class="panel-title">Wynik wyszukiwania</h3></div>' +
            '<div class="panel-body">' + links + '</div></div>'
        );
    }

    function showForm() {
        var form = '<form id="searchForm" class="form-horizontal"><div class="form-group"><label for="nazwa_firmy" class="col-sm-2 control-label">Nazwa</label>' +
                    '<div class="col-sm-10"><input type="text" class="form-control" id="nazwa_firmy" name="nazwa" placeholder="podaj fragment nazwy" required></div></div>' +
                    '<div class="form-group"><div class="col-sm-offset-2 col-sm-10">' +
                    '<button type="submit" class="btn btn-success">Szukaj</button></div></div></form>';
        $contentBox.html('<div id="result" class="panel panel-primary">' +
            '<div class="panel-heading"><h3 class="panel-title">Kryteria wyszukiwania</h3></div>' +
            '<div class="panel-body">' + form + '</div></div>'
        );
    }

    function renderRow(cellSet) {
        var x, rowcells = "";
        for (x in cellSet) {
            rowcells += '<td>' + cellSet[x] + '</td>';
        }
        var row = '<tr>' + rowcells + '</tr>';
        return row;
    }

    function getData(filter) {
        $.ajax({
            url: 'http://localhost:48646/select.php',
            method: 'GET',
            data: {'nazwa': filter},
            dataType: 'json',
            success: function (dane) {
                var x, rows = "";
                for (x in dane) {
                    console.log(dane[x]);
                    rows += renderRow(dane[x]);
                };
                $contentBox.html('<div id="result" class="panel panel-success">' +
                    '<div class="panel-heading"><h3 class="panel-title">Wynik wyszukiwania</h3></div>' +
                    '<div class="panel-body">' +
                    '<table class="table table-striped"><thead><tr><th>Beneficjent</th><th>Kwota</th><th>Za co</th></tr></thead><tbody>' +
                    rows + '</tbody></table></div></div>'
                );
            }
        });
    }

    function showData(rows) {
        $contentBox.html(
        '<table><th><td>Beneficjent</td><td>Kwota</td><td>Za co</td></th>' + rows + '</table>'
        );
    }

    $linkButton.click(function () {
        showLinks("tu lista linków");
    });

    $searchFormButton.click(function () {
        showForm();
    });

    $contentBox.submit(function (e) {
        e.preventDefault();
        var filter = $('#nazwa_firmy').val();
        console.log(filter);
        getData(filter);
    });
})