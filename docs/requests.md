# HTTP requests
Through HTTP requests, in the query parameters, we can specify relations that have to be eager loaded and scopes that are defined on the `Model`.

## Request query parameters
Example HTTP request:  
`/api/v1/users?with=invoices,purchases&scopes=management`

### With
Here we provide a comma seperated list that contains the relation that needs to be eager loaded.

In `BaseQueryBuilder` this list gets injected in the eloquent method `with` to load in the relations.

To eager load nested relationships, you may use "dot" syntax. For example, let's eager load all of the book's authors and all of the author's personal contacts in one HTTP request:

```json
GET /api/v1/books?with=author.contacts

[
    {
        id: 1,
        title: "An awesome title",
        Author: [
            id: 1,
            name: "an awesome name",
            contacts: {
                [
                    id: 1
                ],
            }
        ]
    }
]
```

### Scopes
Local scopes allow you to define common sets of constraints that you may easily re-use throughout your application. For example, you may need to frequently retrieve all users that are "active". To define a scope, prefix an Eloquent model method with scope.

```php
    /**
     * Scope a query to only include active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
```
Our HTTP request will look like this:
```json
GET /api/v1/users?scopes=active

[
    {
        id: 1,
        name: "John Doe",
        active: true
    }
]
```