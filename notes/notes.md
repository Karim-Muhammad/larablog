order of migrations files is important

```bash
❯ php artisan migrate:rollback --path=database/migrations/2023_11_29_204440_create_posts_table.php
❯ php artisan migrate --path=database/migrations/2023_11_29_204440_create_posts_table.php
```

---

```php

// CategoryModel.php
// TEST - A category has many posts
public function users(): HasMany
{
    return $this->hasMany(User::class);
}

// CategoryController.php
dd(Category::find($id)->users);
```

![Alt text](image.png)

### To Show Images in Website should be stored in Public, so we need to create a symbolic link to public/storage from storage/app/public

```bash
    php artisan storage:link
    # to create a symbolic link to public/storage from storage/app/public
```

### Model Binding in `softDeleted` vs. `forceDeleted`

```php
    Products::all();
    // if this model use softDeletes trait, it will return all the products which `deleted_at` is null which means it is not deleted!
    // if not, it will return all the products

    // so how to get all the products either soft deleted or not? use `Products::withTrashed()->get();`
    // to get only trashed products use `Products::onlyTrashed()->get()`
    // to get only not trashed products use `Products::all()` if the model use softDeletes trait


    // when we use model binding for force delete, give us 404 error, because model binding uses
    // `<Model>::findOrFail($id)` under the hood, and this method will look for the record with the given id && `deleted_at` is null
    // since actually record soft deleted, then `deleted_at` is not null, so it will return 404 error (no result)

    // so to solve this problem, we can use `withTrashed()` method as method chaining in route file
    // or we use just $id instead of model binding
    // and query for search with this
    // `Products::withTrashed()->where('id', $id)->firstOrFail()`

```

### To alter existing table and want add just one column

    ```bash
        php artisan make:migration add_column_name_to_table_name_table --table=table_name
    ```

instead of modify for example `create_table_name_table` migration file and run `php artisan migrate:refresh` which will drop the table and create it again and may the information so important to us, so we can use `php artisan make:migration add_column_name_to_table_name_table --table=table_name` which will create new migration file and we can add the column name in `up()` method and run `php artisan migrate` and it will add the column name to the table
