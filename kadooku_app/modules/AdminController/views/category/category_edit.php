
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="wrapper-lg">
            <h5 class="inline font-semibold text-orange m-n">Ubah <?=$category->parent_id != 0 ? 
                                                                                    "Sub Kategori {$category->category_name} dari Kategori {$parent->category_name}" :
                                                                                    "Kategori {$category->category_name}";?>
            </h5>
        </div>
        
        <div class="panel-body width-seratus">
            <form action="" method="post">
                <div class="form-group">
                    <label for="category_name">Nama Kategori</label>
                    <input type="text" class="form-control" name="category_name" value="<?=$category->category_name;?>">
                </div>

                <div class="form-group">
                    <label for="category_description">Deskripsi Kategori</label>
                    <textarea name="category_description" class="form-control" cols="30" rows="5"><?=$category->category_description;?></textarea>
                </div>

                <div class="form-group">
                    <label for="parent_id">Sub Kategori</label>
                    <select name="parent_id" class="form-control">
                        <option value="0">UTAMA</option>
                        <?php foreach($categories as $cat) : 
                            if($category->id != $cat->id) : ?>
                                <option value="<?=$cat->id;?>" 
                                    <?=$cat->id == $category->parent_id ? "selected" : "";?>><?=$cat->category_name;?></option>
                            
                        <?php endif; endforeach;?>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success btn-block">Simpan</button>
                    </div>
                    <div class="col-md-6">
                        <button type="reset" class="btn btn-default btn-block">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>