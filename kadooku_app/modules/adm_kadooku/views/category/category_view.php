
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <label for="category-name">Nama Kategori</label>
                    <input type="text" name="category_name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="category-description">Deskripsi Kategori</label>
                    <textarea name="category_description" id="category-description" cols="30" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="category-parent">Sub Kategori</label>
                    <select name="parent_id" id="category-parent" class="form-control">
                        <option value="0">Kategori Inti</option>
                        <?php foreach($listCategory as $c) :?>
                        <option value="<?=$c->id;?>"><?=$c->category_name;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <?=$kategori;?>
    </div>
</div>