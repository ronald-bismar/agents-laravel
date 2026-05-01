# Agents Laravel

Una aplicación moderna de Laravel 12 con React que integra agentes de IA para automatizar tareas de ventas y atención al cliente. Este proyecto combina la potencia del framework Laravel con herramientas de inteligencia artificial.

## 🚀 Características

- **Agentes de IA**: Asistentes inteligentes impulsados por [Laravel AI](https://laravel.com/docs/ai)
- **SalesAssistant**: Agente especializado en proporcionar información de productos, categorías y órdenes
- **Búsqueda Semántica**: Integración con embeddings para búsquedas inteligentes
- **Múltiples Proveedores de IA**: Soporte para Groq, OpenAI, Gemini, Cohere y más
- **Frontend Moderno**: React 19 con TypeScript y Inertia.js
- **Base de Datos Estructurada**: Modelos para productos, categorías, órdenes y usuarios
- **Autenticación**: Sistema de autenticación completo con Laravel Fortify
- **Testing**: Suite de tests con Pest PHP
- **Herramientas Personalizadas**: Sistema extensible para crear herramientas de IA personalizadas

## 📋 Requisitos Previos

- PHP 8.2 o superior
- Node.js 18+ y npm/yarn
- Composer
- Git
- Una base de datos (MySQL, PostgreSQL, SQLite, etc.)

## 🔧 Instalación

### 1. Clonar el repositorio

```bash
git clone <repository-url>
cd agents-laravel
```

### 2. Instalación automatizada

La forma más fácil es usar el script de setup:

```bash
composer setup
```

Este comando ejecutará automáticamente:
- Instalación de dependencias PHP
- Copiar archivo de configuración `.env`
- Generar clave de aplicación
- Ejecutar migraciones
- Instalar dependencias JavaScript
- Compilar assets de frontend

### 3. Instalación manual (alternativa)

```bash
# Instalar dependencias PHP
composer install

# Crear archivo de entorno
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate

# Ejecutar migraciones
php artisan migrate

# Instalar dependencias JavaScript
npm install

# Compilar assets
npm run build
```

## ⚙️ Configuración

### Variables de Entorno

Edita el archivo `.env` con tus configuraciones:

```env
# Base de Datos
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=agents_laravel
DB_USERNAME=root
DB_PASSWORD=

# Proveedores de IA
GROQ_API_KEY=your-groq-key
OPENAI_API_KEY=your-openai-key
GEMINI_API_KEY=your-gemini-key
COHERE_API_KEY=your-cohere-key
```

### Proveedores de IA Configurados

El proyecto viene pre-configurado con múltiples proveedores en `config/ai.php`:

- **Groq** (por defecto): Texto
- **Gemini**: Imágenes
- **OpenAI**: Audio, transcripción, embeddings
- **Cohere**: Reranking

## 🏃 Uso

### Desarrollo

```bash
# Iniciar servidor de desarrollo de Laravel
php artisan serve

# En otra terminal, compilar assets con Vite
npm run dev
```

Accede a la aplicación en `http://localhost:8000`

### Build de Producción

```bash
npm run build
```

## 📁 Estructura del Proyecto

```
agents-laravel/
├── app/
│   ├── Ai/
│   │   ├── Agents/           # Agentes de IA
│   │   │   └── SalesAssistant.php
│   │   └── Tools/            # Herramientas personalizadas
│   ├── Models/               # Modelos de base de datos
│   │   ├── Product.php
│   │   ├── Category.php
│   │   ├── Order.php
│   │   ├── Embedding.php
│   │   └── User.php
│   ├── Http/
│   │   ├── Controllers/      # Controladores
│   │   ├── Middleware/       # Middleware personalizado
│   │   └── Requests/         # Form Requests
│   ├── Services/             # Servicios
│   │   ├── EmbeddingService.php
│   │   └── ScraperService.php
│   └── Providers/            # Service Providers
├── config/
│   ├── ai.php               # Configuración de IA
│   └── ...                  # Otras configuraciones
├── database/
│   ├── migrations/          # Migraciones
│   ├── seeders/             # Seeders
│   └── factories/           # Factories
├── resources/
│   ├── js/                  # Código React/TypeScript
│   │   ├── app.tsx          # Aplicación principal
│   │   ├── components/      # Componentes React
│   │   ├── layouts/         # Layouts
│   │   ├── pages/           # Páginas
│   │   ├── hooks/           # Custom hooks
│   │   └── types/           # Tipos TypeScript
│   ├── css/                 # Estilos
│   └── views/               # Vistas Blade
├── routes/
│   ├── web.php              # Rutas web
│   ├── console.php          # Comandos
│   └── settings.php         # Rutas de configuración
├── tests/                   # Tests
│   ├── Feature/             # Tests de características
│   └── Unit/                # Tests unitarios
└── stubs/                   # Stubs para generadores
    ├── agent.stub
    ├── structured-agent.stub
    └── tool.stub
```

## 🤖 Agentes Disponibles

### SalesAssistant

El asistente de ventas es el agente principal de la aplicación. Proporciona información sobre:

- **Productos**: Lista y detalles de productos disponibles
- **Categorías**: Información de categorías
- **Órdenes**: Órdenes del usuario actual

**Uso**:

```php
use App\Ai\Agents\SalesAssistant;

$user = auth()->user();
$agent = new SalesAssistant($user);

$response = $agent->prompt('¿Qué productos tienen descuento?')->response();
```

## 🛠️ Herramientas Disponibles

Las herramientas personalizadas se encuentran en `app/Ai/Tools/`:

- **ListProductTool**: Lista productos disponibles
- **ListCategoryTool**: Lista categorías
- **ListOrderToolForUser**: Lista órdenes del usuario
- **SimilaritySearch**: Búsqueda semántica basada en embeddings

## 📝 Comandos Útiles

```bash
# Ejecutar migraciones
php artisan migrate

# Revertir migraciones
php artisan migrate:rollback

# Seedear base de datos
php artisan db:seed

# Ejecutar tests
./vendor/bin/pest

# Linter y formateador PHP
./vendor/bin/pint

# Linter y formateador JavaScript
npm run lint
npm run format

# Verificar tipos TypeScript
npm run types

# Ver logs en tiempo real (requiere Pail)
php artisan pail
```

## 🧪 Testing

Ejecutar la suite completa de tests:

```bash
./vendor/bin/pest
```

Ejecutar tests de una carpeta específica:

```bash
./vendor/bin/pest tests/Feature
./vendor/bin/pest tests/Unit
```

Con cobertura:

```bash
./vendor/bin/pest --coverage
```

## 📦 Dependencias Principales

### Backend
- **Laravel 12**: Framework PHP moderno
- **Laravel AI**: Integración con IA
- **Laravel Fortify**: Autenticación
- **Inertia.js**: Adaptador de Laravel para React
- **Laravel Wayfinder**: Enrutamiento simplificado

### Frontend
- **React 19**: Librería de UI
- **TypeScript**: Tipado estático
- **Tailwind CSS**: Framework de estilos
- **Radix UI**: Componentes sin estilos y accesibles
- **Vite**: Bundler de módulos

### Herramientas de Desarrollo
- **Pest**: Framework de testing PHP
- **ESLint**: Linter JavaScript
- **Prettier**: Formateador de código
- **Pint**: Formateador PHP

## 🔐 Seguridad

- Validación de entrada en todos los formularios
- Protección contra CSRF
- Autenticación segura con Fortify
- Rate limiting en rutas críticas
- Variables sensibles en archivo `.env`

## 📚 Documentación Adicional

- [Documentación de Laravel](https://laravel.com/docs)
- [Documentación de Laravel AI](https://laravel.com/docs/ai)
- [Documentación de Inertia.js](https://inertiajs.com)
- [Documentación de React](https://react.dev)
- [Documentación de Tailwind CSS](https://tailwindcss.com)

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Por favor:

1. Fork el repositorio
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto está licenciado bajo la Licencia MIT - ver el archivo LICENSE para detalles.

## 👤 Autor

Ronald Limachi

## 📞 Soporte

Para reportar problemas o sugerencias, por favor abre un issue en el repositorio.

---

**Última actualización**: Mayo 2026
