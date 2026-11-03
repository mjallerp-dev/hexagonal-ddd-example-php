<?php

declare(strict_types=1);

final class ClassLoader
{
    /**
     * @var array<string, string>
     */
    private static array $classMap = array(
        'InvalidUserEmailException' => 'Domain/Exceptions/InvalidUserEmailException.php',
        'InvalidUserIdException' => 'Domain/Exceptions/InvalidUserIdException.php',
        'InvalidUserNameException' => 'Domain/Exceptions/InvalidUserNameException.php',
        'InvalidUserPasswordException' => 'Domain/Exceptions/InvalidUserPasswordException.php',
        'InvalidUserRoleException' => 'Domain/Exceptions/InvalidUserRoleException.php',
        'InvalidUserStatusException' => 'Domain/Exceptions/InvalidUserStatusException.php',
        'UserAlreadyExistsException' => 'Domain/Exceptions/UserAlreadyExistsException.php',
        'UserNotFoundException' => 'Domain/Exceptions/UserNotFoundException.php',
        'InvalidCredentialsException' => 'Domain/Exceptions/InvalidCredentialsException.php',

        'UserRoleEnum' => 'Domain/Enums/UserRoleEnum.php',
        'UserStatusEnum' => 'Domain/Enums/UserStatusEnum.php',

        'UserId' => 'Domain/ValueObjects/UserId.php',
        'UserName' => 'Domain/ValueObjects/UserName.php',
        'UserEmail' => 'Domain/ValueObjects/UserEmail.php',
        'UserPassword' => 'Domain/ValueObjects/UserPassword.php',

        'UserModel' => 'Domain/Models/UserModel.php',
        'EmailDestinationModel' => 'Domain/Models/EmailDestinationModel.php',
        'EmailSenderException' => 'Domain/Exceptions/EmailSenderException.php',
        'EmailSenderPort' => 'Application/Ports/Out/EmailSenderPort.php',
        'EmailNotificationService' => 'Application/Services/EmailNotificationService.php',
        'EmailSenderService' => 'Infrastructure/Adapters/Email/EmailSenderService.php',

        'CreateUserUseCase' => 'Application/Ports/In/CreateUserUseCase.php',
        'UpdateUserUseCase' => 'Application/Ports/In/UpdateUserUseCase.php',
        'GetUserByIdUseCase' => 'Application/Ports/In/GetUserByIdUseCase.php',
        'GetAllUsersUseCase' => 'Application/Ports/In/GetAllUsersUseCase.php',
        'DeleteUserUseCase' => 'Application/Ports/In/DeleteUserUseCase.php',
        'LoginUseCase' => 'Application/Ports/In/LoginUseCase.php',

        'SaveUserPort' => 'Application/Ports/Out/SaveUserPort.php',
        'UpdateUserPort' => 'Application/Ports/Out/UpdateUserPort.php',
        'GetUserByIdPort' => 'Application/Ports/Out/GetUserByIdPort.php',
        'GetUserByEmailPort' => 'Application/Ports/Out/GetUserByEmailPort.php',
        'GetAllUsersPort' => 'Application/Ports/Out/GetAllUsersPort.php',
        'DeleteUserPort' => 'Application/Ports/Out/DeleteUserPort.php',

        'CreateUserCommand' => 'Application/Services/Dto/Commands/CreateUserCommand.php',
        'UpdateUserCommand' => 'Application/Services/Dto/Commands/UpdateUserCommand.php',
        'DeleteUserCommand' => 'Application/Services/Dto/Commands/DeleteUserCommand.php',
        'LoginCommand' => 'Application/Services/Dto/Commands/LoginCommand.php',
        'GetUserByIdQuery' => 'Application/Services/Dto/Queries/GetUserByIdQuery.php',
        'GetAllUsersQuery' => 'Application/Services/Dto/Queries/GetAllUsersQuery.php',

        'CreateUserService' => 'Application/Services/CreateUserService.php',
        'UpdateUserService' => 'Application/Services/UpdateUserService.php',
        'GetUserByIdService' => 'Application/Services/GetUserByIdService.php',
        'GetAllUsersService' => 'Application/Services/GetAllUsersService.php',
        'DeleteUserService' => 'Application/Services/DeleteUserService.php',
        'LoginService' => 'Application/Services/LoginService.php',
        'UserApplicationMapper' => 'Application/Services/Mappers/UserApplicationMapper.php',

        'Connection' => 'Infrastructure/Adapters/Persistence/PostgreSQL/Config/Connection.php',
        'UserPersistenceDto' => 'Infrastructure/Adapters/Persistence/PostgreSQL/Dto/UserPersistenceDto.php',
        'UserEntity' => 'Infrastructure/Adapters/Persistence/PostgreSQL/Entity/UserEntity.php',
        'UserPersistenceMapper' => 'Infrastructure/Adapters/Persistence/PostgreSQL/Mapper/UserPersistenceMapper.php',
        'UserRepositoryPostgreSQL' => 'Infrastructure/Adapters/Persistence/PostgreSQL/Repository/UserRepositoryPostgreSQL.php',

        'CreateUserWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/CreateUserRequest.php',
        'UpdateUserWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/UpdateUserRequest.php',
        'LoginWebRequest' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/LoginWebRequest.php',
        'UserResponse' => 'Infrastructure/Entrypoints/Web/Controllers/Dto/UserResponse.php',
        'UserWebMapper' => 'Infrastructure/Entrypoints/Web/Controllers/Mapper/UserWebMapper.php',
        'UserController' => 'Infrastructure/Entrypoints/Web/Controllers/UserController.php',
        'WebRoutes' => 'Infrastructure/Entrypoints/Web/Controllers/Config/WebRoutes.php',

        'View' => 'Infrastructure/Entrypoints/Web/Presentation/View.php',
        'Flash' => 'Infrastructure/Entrypoints/Web/Presentation/Flash.php',

        'ArticleModel' => 'Domain/Models/ArticleModel.php',
        'ArticleId' => 'Domain/ValueObjects/ArticleId.php',
        'ArticleDescription' => 'Domain/ValueObjects/ArticleDescription.php',
        'ArticleProvider' => 'Domain/ValueObjects/ArticleProvider.php',
        'ArticleBrand' => 'Domain/ValueObjects/ArticleBrand.php',
        'ArticleModelo' => 'Domain/ValueObjects/ArticleModelo.php',
        'ArticleCategoryEnum' => 'Domain/Enums/ArticleCategoryEnum.php',
        'ArticleStore' => 'Domain/ValueObjects/ArticleStore.php',
        'ArticleQuantity' => 'Domain/ValueObjects/ArticleQuantity.php',
        'ArticlePurchasePrice' => 'Domain/ValueObjects/ArticlePurchasePrice.php',
        'ArticleSalePrice' => 'Domain/ValueObjects/ArticleSalePrice.php',
        'ArticleIva' => 'Domain/ValueObjects/ArticleIva.php',
        'InvalidArticleIdException' => 'Domain/Exceptions/InvalidArticleIdException.php',
        'InvalidArticleDescriptionException' => 'Domain/Exceptions/InvalidArticleDescriptionException.php',
        'InvalidArticleProviderException' => 'Domain/Exceptions/InvalidArticleProviderException.php',
        'InvalidArticleBrandException' => 'Domain/Exceptions/InvalidArticleBrandException.php',
        'InvalidArticleModeloException' => 'Domain/Exceptions/InvalidArticleModeloException.php',
        'InvalidArticleCategoryException' => 'Domain/Exceptions/InvalidArticleCategoryException.php',
        'InvalidArticleStoreException' => 'Domain/Exceptions/InvalidArticleStoreException.php',
        'InvalidArticleQuantityException' => 'Domain/Exceptions/InvalidArticleQuantityException.php',
        'InvalidArticlePurchasePriceException' => 'Domain/Exceptions/InvalidArticlePurchasePriceException.php',
        'InvalidArticleSalePriceException' => 'Domain/Exceptions/InvalidArticleSalePriceException.php',
        'InvalidArticleIvaException' => 'Domain/Exceptions/InvalidArticleIvaException.php',
        'ArticleNotFoundException' => 'Domain/Exceptions/ArticleNotFoundException.php',
        'ArticleAlreadyExistsException' => 'Domain/Exceptions/ArticleAlreadyExistsException.php',

        'CreateArticleUseCase' => 'Application/Ports/In/CreateArticleUseCase.php',
        'UpdateArticleUseCase' => 'Application/Ports/In/UpdateArticleUseCase.php',
        'GetArticleByIdUseCase' => 'Application/Ports/In/GetArticleByIdUseCase.php',
        'GetAllArticlesUseCase' => 'Application/Ports/In/GetAllArticlesUseCase.php',
        'DeleteArticleUseCase' => 'Application/Ports/In/DeleteArticleUseCase.php',

        'SaveArticlePort' => 'Application/Ports/Out/SaveArticlePort.php',
        'UpdateArticlePort' => 'Application/Ports/Out/UpdateArticlePort.php',
        'GetArticleByIdPort' => 'Application/Ports/Out/GetArticleByIdPort.php',
        'GetAllArticlesPort' => 'Application/Ports/Out/GetAllArticlesPort.php',
        'DeleteArticlePort' => 'Application/Ports/Out/DeleteArticlePort.php',

        'CreateArticleCommand' => 'Application/Services/Dto/Commands/CreateArticleCommand.php',
        'UpdateArticleCommand' => 'Application/Services/Dto/Commands/UpdateArticleCommand.php',
        'DeleteArticleCommand' => 'Application/Services/Dto/Commands/DeleteArticleCommand.php',
        'GetArticleByIdQuery' => 'Application/Services/Dto/Queries/GetArticleByIdQuery.php',
        'GetAllArticlesQuery' => 'Application/Services/Dto/Queries/GetAllArticlesQuery.php',

        'CreateArticleService' => 'Application/Services/CreateArticleService.php',
        'UpdateArticleService' => 'Application/Services/UpdateArticleService.php',
        'GetArticleByIdService' => 'Application/Services/GetArticleByIdService.php',
        'GetAllArticlesService' => 'Application/Services/GetAllArticlesService.php',
        'DeleteArticleService' => 'Application/Services/DeleteArticleService.php',
        'ArticleApplicationMapper' => 'Application/Services/Mappers/ArticleApplicationMapper.php',

        'ArticlePersistenceDto' => 'Infrastructure/Adapters/Persistence/PostgreSQL/Dto/ArticlePersistenceDto.php',
        'ArticleEntity' => 'Infrastructure/Adapters/Persistence/PostgreSQL/Entity/ArticleEntity.php',
        'ArticlePersistenceMapper' => 'Infrastructure/Adapters/Persistence/PostgreSQL/Mapper/ArticlePersistenceMapper.php',
        'ArticleRepositoryPostgreSQL' => 'Infrastructure/Adapters/Persistence/PostgreSQL/Repository/ArticleRepositoryPostgreSQL.php',

        'DependencyInjection' => 'Common/DependencyInjection.php',
    );

    public static function register(): void
    {
        spl_autoload_register(array(self::class, 'loadClass'));
    }

    public static function loadClass(string $className): void
    {
        if (!isset(self::$classMap[$className])) {
            return;
        }

        $baseDir = dirname(__DIR__) . DIRECTORY_SEPARATOR;
        $filePath = $baseDir . self::$classMap[$className];

        if (!file_exists($filePath)) {
            throw new RuntimeException(
                sprintf('No se encontró el archivo para la clase %s en %s', $className, $filePath)
            );
        }

        require_once $filePath;
    }
}