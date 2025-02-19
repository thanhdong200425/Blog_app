# Laravel Repository Pattern Project

## SQL Schemas are placed inside ```dump_data``` folder

This project demonstrates the implementation of the Repository Pattern in a Laravel application. The repository pattern helps abstract data persistence logic from business logic and provides a more maintainable and testable codebase.

## Repository Structure

The project uses the following repository structure:

-`app/Contract/` - Contains repository interfaces

    -   `GeneralRepositoryInterface.php` - Base interface with common CRUD operations
    -   `ArticleRepositoryInterface.php` - Article-specific operations
    -   `CommentRepositoryInterface.php` - Comment-specific operations
    -   `LikeRepositoryInterface.php` - Like-specific operations
    -   `UserRepositoryInterface.php` - User-specific operations

-`app/Repositories/` - Contains repository implementations
    -   `BaseRepository.php` - Abstract base class implementing common CRUD operations
    -   `ArticleRepository.php` - Article repository implementation
    -   `CommentRepository.php` - Comment repository implementation
    -   `LikeRepository.php` - Like repository implementation
    -   `UserRepository.php` - User repository implementation

## Key Features

- Separation of concerns between data access and business logic
- Consistent interface for data operations
- Easy to maintain and test
- Swappable implementations without affecting business logic
- Type-hinted repository injection

## Usage Example

```php
class ArticleController extends Controller
{
    private $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function index()
    {
        return $this->articleRepository->getAll();
    }
}
```
