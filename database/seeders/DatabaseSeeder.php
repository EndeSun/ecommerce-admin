<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\Cart_line;
use App\Models\Category;
use App\Models\Favourite;
use App\Models\Comment;




class DatabaseSeeder extends Seeder
{
    /* Para Empezar la base de datos con algunos datos --> Semillas */
    //Usuarios 
    private $usuarios = [
        ['rol' => 'client', 'password' => '123', 'name' => 'Ende', 'surname' => 'Sun', 'phone' => 681671050, 'email' => '1195562121ende@gmail.com', 'street' => 'Calle Francia 1, 41', 'city' => 'Alicante', 'state' => 'Comunidad Valenciana', 'CP' => '03690', 'registration_date' => '2021-12-24'],
        ['rol' => 'admin', 'password' => '456', 'name' => 'John', 'surname' => 'Doe', 'phone' => 123456789, 'email' => 'john.doe@example.com', 'street' => '123 Main St', 'city' => 'New York', 'state' => 'NY', 'CP' => '10001', 'registration_date' => '2022-01-15'],
        ['rol' => 'worker', 'password' => '789', 'name' => 'Alice', 'surname' => 'Smith', 'phone' => 987654321, 'email' => 'alice.smith@example.com', 'street' => '456 Oak Ave', 'city' => 'Los Angeles', 'state' => 'CA', 'CP' => '90001', 'registration_date' => '2022-02-05'],
        ['rol' => 'worker', 'password' => 'abc', 'name' => 'Emma', 'surname' => 'Johnson', 'phone' => 555666777, 'email' => 'emma.johnson@example.com', 'street' => '789 Pine Rd', 'city' => 'Chicago', 'state' => 'IL', 'CP' => '60601', 'registration_date' => '2022-03-20'],
        ['rol' => 'worker', 'password' => 'def', 'name' => 'Michael', 'surname' => 'Brown', 'phone' => 333222111, 'email' => 'michael.brown@example.com', 'street' => '101 Elm Ln', 'city' => 'Houston', 'state' => 'TX', 'CP' => '77001', 'registration_date' => '2022-04-10'],
        ['rol' => 'worker', 'password' => 'ghi', 'name' => 'Sophia', 'surname' => 'Martinez', 'phone' => 999888777, 'email' => 'sophia.martinez@example.com', 'street' => '222 Maple Blvd', 'city' => 'Phoenix', 'state' => 'AZ', 'CP' => '85001', 'registration_date' => '2022-05-25'],
        ['rol' => 'client', 'password' => '456', 'name' => 'Luis', 'surname' => 'González', 'phone' => 333444555, 'email' => 'luis.gonzalez@example.com', 'street' => '333 Cedar St', 'city' => 'Miami', 'state' => 'FL', 'CP' => '33101', 'registration_date' => '2022-06-30'],
        ['rol' => 'admin', 'password' => '789', 'name' => 'Emily', 'surname' => 'Taylor', 'phone' => 666777888, 'email' => 'emily.taylor@example.com', 'street' => '444 Pine Ave', 'city' => 'San Francisco', 'state' => 'CA', 'CP' => '94101', 'registration_date' => '2022-07-15'],
        ['rol' => 'worker', 'password' => 'abc', 'name' => 'David', 'surname' => 'Rodriguez', 'phone' => 222333444, 'email' => 'david.rodriguez@example.com', 'street' => '555 Oak St', 'city' => 'Seattle', 'state' => 'WA', 'CP' => '98101', 'registration_date' => '2022-08-20'],
        ['rol' => 'worker', 'password' => 'def', 'name' => 'Sophie', 'surname' => 'Brown', 'phone' => 777888999, 'email' => 'sophie.brown@example.com', 'street' => '666 Elm Blvd', 'city' => 'Denver', 'state' => 'CO', 'CP' => '80201', 'registration_date' => '2022-09-05'],
        ['rol' => 'worker', 'password' => 'ghi', 'name' => 'Daniel', 'surname' => 'Lee', 'phone' => 111222333, 'email' => 'daniel.lee@example.com', 'street' => '777 Cedar Ave', 'city' => 'Dallas', 'state' => 'TX', 'CP' => '75201', 'registration_date' => '2022-10-10'],
        ['rol' => 'worker', 'password' => '123', 'name' => 'Olivia', 'surname' => 'Martinez', 'phone' => 888999000, 'email' => 'olivia.martinez@example.com', 'street' => '888 Pine Rd', 'city' => 'Las Vegas', 'state' => 'NV', 'CP' => '89101', 'registration_date' => '2022-11-25'],
        ['rol' => 'client', 'password' => 'abc', 'name' => 'Juan', 'surname' => 'Perez', 'phone' => 555444333, 'email' => 'juan.perez@example.com', 'street' => '999 Maple St', 'city' => 'Orlando', 'state' => 'FL', 'CP' => '32801', 'registration_date' => '2022-12-30'],
        ['rol' => 'admin', 'password' => 'def', 'name' => 'Emma', 'surname' => 'Williams', 'phone' => 888777666, 'email' => 'emma.williams@example.com', 'street' => '123 Oak Ave', 'city' => 'Atlanta', 'state' => 'GA', 'CP' => '30301', 'registration_date' => '2023-01-05'],
        ['rol' => 'worker', 'password' => 'ghi', 'name' => 'Lucas', 'surname' => 'Garcia', 'phone' => 222555888, 'email' => 'lucas.garcia@example.com', 'street' => '456 Cedar St', 'city' => 'Boston', 'state' => 'MA', 'CP' => '02101', 'registration_date' => '2023-02-10'],
    ];
    private function seedUsers()
    {
        DB::table('users')->delete();
        foreach ($this->usuarios as $usuario) {
            $p = new User;
            $p->rol = $usuario['rol'];
            $p->password = bcrypt($usuario['password']);
            $p->name = $usuario['name'];
            $p->surname = $usuario['surname'];
            $p->phone = $usuario['phone'];
            $p->email = $usuario['email'];
            $p->street = $usuario['street'];
            $p->city = $usuario['city'];
            $p->state = $usuario['state'];
            $p->CP = $usuario['CP'];
            $p->registration_date = $usuario['registration_date'];
            $p->save();
        }

    }
    //Categorías
    private $categories = [
        ['category_id' => null, 'name' => 'Chuches', 'imagen' => null, 'fondo' => null],
        ['category_id' => null, 'name' => 'Chuches', 'imagen' => null, 'fondo' => null],
        ['category_id' => null, 'name' => 'Electrodomésticos', 'imagen' => null, 'fondo' => null],
        ['category_id' => null, 'name' => 'Ropa', 'imagen' => null, 'fondo' => null],
        ['category_id' => null, 'name' => 'Juguetes', 'imagen' => null, 'fondo' => null],
        ['category_id' => null, 'name' => 'Libros', 'imagen' => null, 'fondo' => null],
        ['category_id' => null, 'name' => 'Música', 'imagen' => null, 'fondo' => null],
        ['category_id' => null, 'name' => 'Electrónica', 'imagen' => null, 'fondo' => null],
        ['category_id' => null, 'name' => 'Deportes', 'imagen' => null, 'fondo' => null],
        ['category_id' => null, 'name' => 'Hogar', 'imagen' => null, 'fondo' => null],
        ['category_id' => null, 'name' => 'Belleza', 'imagen' => null, 'fondo' => null],
        ['category_id' => null, 'name' => 'Videojuegos', 'imagen' => null, 'fondo' => null],
        ['category_id' => null, 'name' => 'Alimentación', 'imagen' => null, 'fondo' => null],
        ['category_id' => null, 'name' => 'Salud', 'imagen' => null, 'fondo' => null],
        ['category_id' => null, 'name' => 'Automóviles', 'imagen' => null, 'fondo' => null],
        ['category_id' => null, 'name' => 'Mascotas', 'imagen' => null, 'fondo' => null],
        ['category_id' => null, 'name' => 'Viajes', 'imagen' => null, 'fondo' => null],
        ['category_id' => null, 'name' => 'Tecnología', 'imagen' => null, 'fondo' => null],
        ['category_id' => null, 'name' => 'Arte y artesanía', 'imagen' => null, 'fondo' => null],
        ['category_id' => null, 'name' => 'Educación', 'imagen' => null, 'fondo' => null],
        ['category_id' => null, 'name' => 'Finanzas', 'imagen' => null, 'fondo' => null],
        ['category_id' => 1, 'name' => 'Gominolas', 'imagen' => null, 'fondo' => null],
        ['category_id' => 1, 'name' => 'Chocolate', 'imagen' => null, 'fondo' => null],
        ['category_id' => 2, 'name' => 'Lavadoras', 'imagen' => null, 'fondo' => null],
        ['category_id' => 2, 'name' => 'Frigoríficos', 'imagen' => null, 'fondo' => null],
        ['category_id' => 3, 'name' => 'Camisetas', 'imagen' => null, 'fondo' => null],
        ['category_id' => 3, 'name' => 'Pantalones', 'imagen' => null, 'fondo' => null],
        ['category_id' => 4, 'name' => 'Pelotas', 'imagen' => null, 'fondo' => null],
        ['category_id' => 4, 'name' => 'Muñecas', 'imagen' => null, 'fondo' => null],
        ['category_id' => 5, 'name' => 'Novelas', 'imagen' => null, 'fondo' => null],
        ['category_id' => 5, 'name' => 'Poesía', 'imagen' => null, 'fondo' => null],
        ['category_id' => 1, 'name' => 'Chuches Especiales', 'imagen' => null, 'fondo' => null],
        ['category_id' => 2, 'name' => 'Electrodomésticos Premium', 'imagen' => null, 'fondo' => null],
        ['category_id' => 3, 'name' => 'Ropa de Diseñador', 'imagen' => null, 'fondo' => null],
        ['category_id' => 4, 'name' => 'Juguetes Educativos', 'imagen' => null, 'fondo' => null],
        ['category_id' => 5, 'name' => 'Libros de Ciencia Ficción', 'imagen' => null, 'fondo' => null],
        ['category_id' => 6, 'name' => 'Música Clásica', 'imagen' => null, 'fondo' => null],
        ['category_id' => 7, 'name' => 'Electrónica de Alta Gama', 'imagen' => null, 'fondo' => null],
        ['category_id' => 8, 'name' => 'Equipamiento Deportivo Profesional', 'imagen' => null, 'fondo' => null],
        ['category_id' => 9, 'name' => 'Decoración del Hogar Elegante', 'imagen' => null, 'fondo' => null],
        ['category_id' => 10, 'name' => 'Productos de Belleza Orgánicos', 'imagen' => null, 'fondo' => null],
        ['category_id' => 11, 'name' => 'Videojuegos Retro', 'imagen' => null, 'fondo' => null],
        ['category_id' => 12, 'name' => 'Alimentación Gourmet', 'imagen' => null, 'fondo' => null],
        ['category_id' => 13, 'name' => 'Suplementos Naturales', 'imagen' => null, 'fondo' => null],
        ['category_id' => 14, 'name' => 'Accesorios para Automóviles', 'imagen' => null, 'fondo' => null],
        ['category_id' => 15, 'name' => 'Juguetes para Mascotas', 'imagen' => null, 'fondo' => null],
        ['category_id' => 16, 'name' => 'Paquetes Vacacionales de Lujo', 'imagen' => null, 'fondo' => null],
        ['category_id' => 17, 'name' => 'Última Tecnología en Electrónica', 'imagen' => null, 'fondo' => null],
        ['category_id' => 18, 'name' => 'Arte Contemporáneo', 'imagen' => null, 'fondo' => null],
        ['category_id' => 19, 'name' => 'Educación Online Avanzada', 'imagen' => null, 'fondo' => null],
        ['category_id' => 20, 'name' => 'Asesoramiento Financiero Personalizado', 'imagen' => null, 'fondo' => null],
        ['category_id' => 21, 'name' => 'Aperitivos Saludables', 'imagen' => null, 'fondo' => null],
        ['category_id' => 22, 'name' => 'Productos para el Cuidado de la Piel', 'imagen' => null, 'fondo' => null],
        ['category_id' => 23, 'name' => 'Accesorios de Viaje Innovadores', 'imagen' => null, 'fondo' => null],
        ['category_id' => 24, 'name' => 'Dispositivos Tecnológicos Avanzados', 'imagen' => null, 'fondo' => null],
        ['category_id' => 25, 'name' => 'Artesanía Hecha a Mano', 'imagen' => null, 'fondo' => null],
        ['category_id' => 26, 'name' => 'Cursos de Desarrollo Profesional', 'imagen' => null, 'fondo' => null],
        ['category_id' => 27, 'name' => 'Planificación Financiera', 'imagen' => null, 'fondo' => null],
        ['category_id' => 28, 'name' => 'Snacks Ecológicos', 'imagen' => null, 'fondo' => null],
        ['category_id' => 29, 'name' => 'Productos de Maquillaje Sostenibles', 'imagen' => null, 'fondo' => null],
        ['category_id' => 30, 'name' => 'Equipaje de Viaje Innovador', 'imagen' => null, 'fondo' => null],
    ];

    private function seedCategories()
    {
        DB::table('categories')->delete();
        foreach ($this->categories as $category) {
            $c = new Category;
            $c->category_id = $category['category_id'];
            $c->name = ($category['name']);
            $c->imagen = $category['imagen'];
            $c->fondo = $category['fondo'];
            $c->save();
        }
    }
    //Productos
    private $products = [
        ['name' => 'Chocolate blanco', 'price' => 5, 'discount' => 0, 'description_short' => 'Chocolate blanco puro alta calidad', 'description_large' => 'Descripción larga del chocolate blanco', 'imagen' => null, 'reference' => "#12312432", 'category_id' => 2, 'stock' => 2000],
        ['name' => 'Tableta de Chocolate con Leche', 'price' => 3.5, 'discount' => 0, 'description_short' => 'Tableta de chocolate con leche', 'description_large' => 'Tableta de chocolate con leche de alta calidad', 'imagen' => null, 'reference' => "#23451234", 'category_id' => 1, 'stock' => 1500],
        ['name' => 'Galletas de Chocolate', 'price' => 2, 'discount' => 0, 'description_short' => 'Galletas de chocolate crujientes', 'description_large' => 'Galletas de chocolate con trozos de chocolate negro', 'imagen' => null, 'reference' => "#34562345", 'category_id' => 4, 'stock' => 3000],
        ['name' => 'Chocolate Negro 70%', 'price' => 4, 'discount' => 0, 'description_short' => 'Chocolate negro intenso', 'description_large' => 'Tableta de chocolate negro con alto porcentaje de cacao', 'imagen' => null, 'reference' => "#45673456", 'category_id' => 2, 'stock' => 1800],
        ['name' => 'Barras de Caramelo', 'price' => 1.5, 'discount' => 0, 'description_short' => 'Barras de caramelo surtidas', 'description_large' => 'Pack de barras de caramelo de diferentes sabores', 'imagen' => null, 'reference' => "#56784567", 'category_id' => 3, 'stock' => 2500],
        ['name' => 'Bombones de Chocolate', 'price' => 6, 'discount' => 0, 'description_short' => 'Bombones de chocolate surtidos', 'description_large' => 'Caja de bombones de chocolate rellenos de diferentes sabores', 'imagen' => null, 'reference' => "#67895678", 'category_id' => 2, 'stock' => 1200],
        ['name' => 'Chocolate Caliente Instantáneo', 'price' => 8, 'discount' => 0, 'description_short' => 'Preparado para chocolate caliente', 'description_large' => 'Bote de polvo para preparar chocolate caliente instantáneo', 'imagen' => null, 'reference' => "#78906789", 'category_id' => 5, 'stock' => 900],
        ['name' => 'Trufas de Chocolate', 'price' => 7, 'discount' => 0, 'description_short' => 'Trufas de chocolate suave', 'description_large' => 'Caja de trufas de chocolate negro y blanco', 'imagen' => null, 'reference' => "#89017890", 'category_id' => 1, 'stock' => 1400],
        ['name' => 'Chips de Chocolate', 'price' => 2.5, 'discount' => 0, 'description_short' => 'Chips de chocolate para hornear', 'description_large' => 'Bolsa de chips de chocolate para agregar a tus recetas', 'imagen' => null, 'reference' => "#90128901", 'category_id' => 4, 'stock' => 2800],
        ['name' => 'Crema de Avellanas y Chocolate', 'price' => 9, 'discount' => 0, 'description_short' => 'Crema de avellanas y chocolate', 'description_large' => 'Tarro de crema de avellanas con trozos de chocolate', 'imagen' => null, 'reference' => "#01239012", 'category_id' => 2, 'stock' => 1100],
        ['name' => 'Chocolate con Almendras', 'price' => 3.8, 'discount' => 0, 'description_short' => 'Tableta de chocolate con almendras', 'description_large' => 'Tableta de chocolate con trozos de almendra tostada', 'imagen' => null, 'reference' => "#12340123", 'category_id' => 1, 'stock' => 1600],
        ['name' => 'Tarta de Chocolate', 'price' => 12, 'discount' => 0, 'description_short' => 'Tarta de chocolate recién horneada', 'description_large' => 'Deliciosa tarta de chocolate cubierta con crema de chocolate', 'imagen' => null, 'reference' => "#23451234", 'category_id' => 5, 'stock' => 750],
        ['name' => 'Chocolate con Naranja', 'price' => 4.2, 'discount' => 0, 'description_short' => 'Tableta de chocolate con trozos de naranja', 'description_large' => 'Tableta de chocolate negro con trozos de naranja confitada', 'imagen' => null, 'reference' => "#34562345", 'category_id' => 2, 'stock' => 1750],
        ['name' => 'Barras de Chocolate Energéticas', 'price' => 2.2, 'discount' => 0, 'description_short' => 'Barras de chocolate con ingredientes naturales', 'description_large' => 'Pack de barras de chocolate con frutos secos y semillas', 'imagen' => null, 'reference' => "#45673456", 'category_id' => 3, 'stock' => 3200],
        ['name' => 'Helado de Chocolate', 'price' => 3.5, 'discount' => 0, 'description_short' => 'Helado de chocolate cremoso', 'description_large' => 'Tarrina de helado de chocolate artesanal', 'imagen' => null, 'reference' => "#56784567", 'category_id' => 1, 'stock' => 1200],
        ['name' => 'Chocolate Blanco con Fresas', 'price' => 4.5, 'discount' => 0, 'description_short' => 'Tableta de chocolate blanco con trozos de fresa', 'description_large' => 'Tableta de chocolate blanco con trozos de fresa liofilizada', 'imagen' => null, 'reference' => "#67895678", 'category_id' => 2, 'stock' => 1850],
        ['name' => 'Brownie de Chocolate', 'price' => 2.8, 'discount' => 0, 'description_short' => 'Brownie de chocolate esponjoso', 'description_large' => 'Porción de brownie de chocolate con nueces', 'imagen' => null, 'reference' => "#78906789", 'category_id' => 5, 'stock' => 850],
        ['name' => 'Crema de Chocolate para Untar', 'price' => 7.5, 'discount' => 0, 'description_short' => 'Crema de chocolate para untar', 'description_large' => 'Tarro de crema de chocolate ideal para untar en pan', 'imagen' => null, 'reference' => "#89017890", 'category_id' => 2, 'stock' => 1350],
        ['name' => 'Barritas de Chocolate Negro', 'price' => 1.8, 'discount' => 0, 'description_short' => 'Barritas de chocolate negro intenso', 'description_large' => 'Pack de barritas de chocolate negro para picar entre horas', 'imagen' => null, 'reference' => "#90128901", 'category_id' => 1, 'stock' => 2100],
        ['name' => 'Chocolate con Menta', 'price' => 4.3, 'discount' => 0, 'description_short' => 'Tableta de chocolate con menta', 'description_large' => 'Tableta de chocolate negro con trozos de menta fresca', 'imagen' => null, 'reference' => "#01239012", 'category_id' => 2, 'stock' => 1900],
        ['name' => 'Galletas de Avena y Chocolate', 'price' => 2.3, 'discount' => 0, 'description_short' => 'Galletas de avena con trozos de chocolate', 'description_large' => 'Bolsa de galletas de avena con chips de chocolate', 'imagen' => null, 'reference' => "#12340123", 'category_id' => 4, 'stock' => 2950],
        ['name' => 'Fondue de Chocolate', 'price' => 15, 'discount' => 0, 'description_short' => 'Fondue de chocolate con frutas', 'description_large' => 'Set de fondue de chocolate con fresas y plátano', 'imagen' => null, 'reference' => "#23451234", 'category_id' => 5, 'stock' => 700],
        ['name' => 'Chocolate con Caramelo', 'price' => 4.6, 'discount' => 0, 'description_short' => 'Tableta de chocolate con trozos de caramelo', 'description_large' => 'Tableta de chocolate negro con trozos de caramelo salado', 'imagen' => null, 'reference' => "#34562345", 'category_id' => 2, 'stock' => 1700],
        ['name' => 'Pastelitos de Chocolate', 'price' => 3, 'discount' => 0, 'description_short' => 'Pastelitos de chocolate esponjosos', 'description_large' => 'Pack de pastelitos de chocolate decorados con virutas de chocolate', 'imagen' => null, 'reference' => "#45673456", 'category_id' => 1, 'stock' => 1300],
        ['name' => 'Chocolate con Cerezas', 'price' => 4.8, 'discount' => 0, 'description_short' => 'Tableta de chocolate con trozos de cereza', 'description_large' => 'Tableta de chocolate negro con trozos de cereza confitada', 'imagen' => null, 'reference' => "#56784567", 'category_id' => 2, 'stock' => 1950],
        ['name' => 'Crema de Chocolate y Avellanas', 'price' => 8, 'discount' => 0, 'description_short' => 'Crema de chocolate y avellanas', 'description_large' => 'Tarro de crema de chocolate y avellanas con trozos de avellana', 'imagen' => null, 'reference' => "#67895678", 'category_id' => 2, 'stock' => 1250],
        ['name' => 'Tableta de Chocolate con Nuez', 'price' => 4.5, 'discount' => 0, 'description_short' => 'Tableta de chocolate con trozos de nuez', 'description_large' => 'Tableta de chocolate negro con trozos de nuez crujiente', 'imagen' => null, 'reference' => "#78906789", 'category_id' => 1, 'stock' => 1700],
        ['name' => 'Chocolate en Polvo', 'price' => 3.2, 'discount' => 0, 'description_short' => 'Polvo de chocolate para hacer bebidas', 'description_large' => 'Bote de polvo de chocolate para preparar bebidas calientes', 'imagen' => null, 'reference' => "#89017890", 'category_id' => 5, 'stock' => 1100],
        ['name' => 'Barritas Energéticas de Chocolate', 'price' => 2.2, 'discount' => 0, 'description_short' => 'Barritas energéticas con chocolate', 'description_large' => 'Pack de barritas energéticas de chocolate y frutos secos', 'imagen' => null, 'reference' => "#90128901", 'category_id' => 3, 'stock' => 3000],
        ['name' => 'Chocolate con Avellanas', 'price' => 4.7, 'discount' => 0, 'description_short' => 'Tableta de chocolate con trozos de avellana', 'description_large' => 'Tableta de chocolate con trozos de avellana tostada', 'imagen' => null, 'reference' => "#01239012", 'category_id' => 1, 'stock' => 1550],
        ['name' => 'Mousse de Chocolate', 'price' => 6.5, 'discount' => 0, 'description_short' => 'Mousse de chocolate suave', 'description_large' => 'Envase de mousse de chocolate listo para servir', 'imagen' => null, 'reference' => "#12340123", 'category_id' => 5, 'stock' => 800],
        ['name' => 'Chocolate con Frutos Secos', 'price' => 5, 'discount' => 0, 'description_short' => 'Tableta de chocolate con frutos secos', 'description_large' => 'Tableta de chocolate negro con trozos de frutos secos variados', 'imagen' => null, 'reference' => "#23451234", 'category_id' => 1, 'stock' => 1750],
        ['name' => 'Barra de Chocolate con Coco', 'price' => 4.4, 'discount' => 0, 'description_short' => 'Barra de chocolate con trozos de coco', 'description_large' => 'Barra de chocolate negro con trozos de coco rallado', 'imagen' => null, 'reference' => "#34562345", 'category_id' => 2, 'stock' => 1850],
        ['name' => 'Brownie de Chocolate Blanco', 'price' => 3, 'discount' => 0, 'description_short' => 'Brownie de chocolate blanco', 'description_large' => 'Porción de brownie de chocolate blanco con chips de chocolate negro', 'imagen' => null, 'reference' => "#45673456", 'category_id' => 5, 'stock' => 900],
        ['name' => 'Crema de Chocolate Blanco', 'price' => 7.5, 'discount' => 0, 'description_short' => 'Crema de chocolate blanco', 'description_large' => 'Tarro de crema de chocolate blanco para untar', 'imagen' => null, 'reference' => "#56784567", 'category_id' => 2, 'stock' => 1400],
        ['name' => 'Chocolate con Almendras y Sal Marina', 'price' => 5.2, 'discount' => 0, 'description_short' => 'Tableta de chocolate con almendras y sal', 'description_large' => 'Tableta de chocolate negro con trozos de almendras tostadas y sal marina', 'imagen' => null, 'reference' => "#67895678", 'category_id' => 1, 'stock' => 1600],
        ['name' => 'Chocolate Amargo 85%', 'price' => 4.5, 'discount' => 0, 'description_short' => 'Chocolate amargo de alta pureza', 'description_large' => 'Tableta de chocolate negro con alto porcentaje de cacao', 'imagen' => null, 'reference' => "#78906789", 'category_id' => 2, 'stock' => 1850],
        ['name' => 'Crema de Chocolate y Avellanas Sin Azúcar', 'price' => 9, 'discount' => 0, 'description_short' => 'Crema de chocolate y avellanas sin azúcar añadido', 'description_large' => 'Tarro de crema de chocolate y avellanas endulzado con edulcorantes naturales', 'imagen' => null, 'reference' => "#89017890", 'category_id' => 2, 'stock' => 1200],
        ['name' => 'Trufas de Chocolate Negro', 'price' => 8, 'discount' => 0, 'description_short' => 'Trufas de chocolate negro suave', 'description_large' => 'Caja de trufas de chocolate negro con cobertura de cacao en polvo', 'imagen' => null, 'reference' => "#90128901", 'category_id' => 1, 'stock' => 1550],
        ['name' => 'Barras de Chocolate Blanco', 'price' => 2, 'discount' => 0, 'description_short' => 'Barras de chocolate blanco puras', 'description_large' => 'Pack de barras de chocolate blanco de alta calidad', 'imagen' => null, 'reference' => "#01239012", 'category_id' => 3, 'stock' => 3300],
        ['name' => 'Chocolate con Pistachos', 'price' => 5.3, 'discount' => 0, 'description_short' => 'Tableta de chocolate con trozos de pistacho', 'description_large' => 'Tableta de chocolate negro con trozos de pistacho tostado', 'imagen' => null, 'reference' => "#12340123", 'category_id' => 1, 'stock' => 1800],
        ['name' => 'Tarta de Chocolate y Avellanas', 'price' => 13, 'discount' => 0, 'description_short' => 'Tarta de chocolate y avellanas con base de galleta', 'description_large' => 'Tarta de chocolate y avellanas cubierta de ganache de chocolate', 'imagen' => null, 'reference' => "#23451234", 'category_id' => 5, 'stock' => 700],
        ['name' => 'Chocolate con Frambuesa', 'price' => 4.4, 'discount' => 0, 'description_short' => 'Tableta de chocolate con trozos de frambuesa', 'description_large' => 'Tableta de chocolate negro con trozos de frambuesa liofilizada', 'imagen' => null, 'reference' => "#34562345", 'category_id' => 2, 'stock' => 1750],
        ['name' => 'Cookies de Chocolate y Nueces', 'price' => 2.5, 'discount' => 0, 'description_short' => 'Cookies de chocolate con nueces', 'description_large' => 'Bolsa de cookies de chocolate negro con trozos de nuez', 'imagen' => null, 'reference' => "#45673456", 'category_id' => 4, 'stock' => 2900],
        ['name' => 'Chocolate con Plátano', 'price' => 4.6, 'discount' => 0, 'description_short' => 'Tableta de chocolate con trozos de plátano', 'description_large' => 'Tableta de chocolate negro con trozos de plátano deshidratado', 'imagen' => null, 'reference' => "#56784567", 'category_id' => 2, 'stock' => 1900],
        ['name' => 'Crema de Chocolate con Leche', 'price' => 6.5, 'discount' => 0, 'description_short' => 'Crema de chocolate con leche', 'description_large' => 'Tarro de crema de chocolate con leche para untar en tostadas', 'imagen' => null, 'reference' => "#67895678", 'category_id' => 2, 'stock' => 1300],
        ['name' => 'Chocolate con Cacahuetes', 'price' => 4.7, 'discount' => 0, 'description_short' => 'Tableta de chocolate con trozos de cacahuetes', 'description_large' => 'Tableta de chocolate negro con trozos de cacahuetes tostados', 'imagen' => null, 'reference' => "#78906789", 'category_id' => 1, 'stock' => 1650],
        ['name' => 'Helado de Chocolate con Avellanas', 'price' => 4.5, 'discount' => 0, 'description_short' => 'Helado de chocolate con avellanas', 'description_large' => 'Tarrina de helado de chocolate con trozos de avellana', 'imagen' => null, 'reference' => "#89017890", 'category_id' => 1, 'stock' => 1350],
        ['name' => 'Chocolate Blanco con Arándanos', 'price' => 4.7, 'discount' => 0, 'description_short' => 'Tableta de chocolate blanco con trozos de arándano', 'description_large' => 'Tableta de chocolate blanco con trozos de arándano deshidratado', 'imagen' => null, 'reference' => "#90128901", 'category_id' => 2, 'stock' => 1800],
        ['name' => 'Crema de Chocolate Negro', 'price' => 8, 'discount' => 0, 'description_short' => 'Crema de chocolate negro para untar', 'description_large' => 'Tarro de crema de chocolate negro sin azúcar añadido', 'imagen' => null, 'reference' => "#01239012", 'category_id' => 2, 'stock' => 1250],
        ['name' => 'Chocolate con Coco', 'price' => 4.3, 'discount' => 0, 'description_short' => 'Tableta de chocolate con trozos de coco', 'description_large' => 'Tableta de chocolate negro con trozos de coco rallado', 'imagen' => null, 'reference' => "#12340123", 'category_id' => 1, 'stock' => 1700],
        ['name' => 'Tarta de Chocolate y Frambuesa', 'price' => 12, 'discount' => 0, 'description_short' => 'Tarta de chocolate y frambuesa con base de bizcocho', 'description_large' => 'Tarta de chocolate y frambuesa cubierta con ganache de chocolate', 'imagen' => null, 'reference' => "#23451234", 'category_id' => 5, 'stock' => 800],
        ['name' => 'Chocolate con Grosellas', 'price' => 4.4, 'discount' => 0, 'description_short' => 'Tableta de chocolate con trozos de grosellas', 'description_large' => 'Tableta de chocolate negro con trozos de grosellas liofilizadas', 'imagen' => null, 'reference' => "#34562345", 'category_id' => 2, 'stock' => 1750],
        ['name' => 'Chocolate Negro 70%', 'price' => 4, 'discount' => 15, 'description_short' => 'Chocolate negro intenso', 'description_large' => 'Tableta de chocolate negro con alto porcentaje de cacao', 'imagen' => null, 'reference' => "#45673456", 'category_id' => 2, 'stock' => 1800],
        ['name' => 'Chocolate con Almendras', 'price' => 3.8, 'discount' => 10, 'description_short' => 'Tableta de chocolate con almendras', 'description_large' => 'Tableta de chocolate con trozos de almendra tostada', 'imagen' => null, 'reference' => "#12340123", 'category_id' => 1, 'stock' => 1600],
        ['name' => 'Chocolate con Naranja', 'price' => 4.2, 'discount' => 20, 'description_short' => 'Tableta de chocolate con trozos de naranja', 'description_large' => 'Tableta de chocolate negro con trozos de naranja confitada', 'imagen' => null, 'reference' => "#34562345", 'category_id' => 2, 'stock' => 1750],
        ['name' => 'Chocolate con Caramelo', 'price' => 4.6, 'discount' => 12, 'description_short' => 'Tableta de chocolate con trozos de caramelo', 'description_large' => 'Tableta de chocolate negro con trozos de caramelo salado', 'imagen' => null, 'reference' => "#56784567", 'category_id' => 2, 'stock' => 1700],
        ['name' => 'Chocolate con Menta', 'price' => 4.3, 'discount' => 18, 'description_short' => 'Tableta de chocolate con menta', 'description_large' => 'Tableta de chocolate negro con trozos de menta fresca', 'imagen' => null, 'reference' => "#01239012", 'category_id' => 2, 'stock' => 1900],
        ['name' => 'Chocolate con Cerezas', 'price' => 4.8, 'discount' => 25, 'description_short' => 'Tableta de chocolate con trozos de cereza', 'description_large' => 'Tableta de chocolate negro con trozos de cereza confitada', 'imagen' => null, 'reference' => "#78906789", 'category_id' => 1, 'stock' => 1950],
        ['name' => 'Chocolate con Avellanas', 'price' => 4.7, 'discount' => 15, 'description_short' => 'Tableta de chocolate con trozos de avellana', 'description_large' => 'Tableta de chocolate con trozos de avellana tostada', 'imagen' => null, 'reference' => "#89017890", 'category_id' => 1, 'stock' => 1550],
        ['name' => 'Chocolate con Pistachos', 'price' => 5.3, 'discount' => 10, 'description_short' => 'Tableta de chocolate con trozos de pistacho', 'description_large' => 'Tableta de chocolate negro con trozos de pistacho tostado', 'imagen' => null, 'reference' => "#12340123", 'category_id' => 1, 'stock' => 1800],
        ['name' => 'Chocolate con Frambuesa', 'price' => 4.4, 'discount' => 20, 'description_short' => 'Tableta de chocolate con trozos de frambuesa', 'description_large' => 'Tableta de chocolate negro con trozos de frambuesa liofilizada', 'imagen' => null, 'reference' => "#34562345", 'category_id' => 2, 'stock' => 1750],
        ['name' => 'Chocolate con Coco', 'price' => 4.3, 'discount' => 15, 'description_short' => 'Tableta de chocolate con trozos de coco', 'description_large' => 'Tableta de chocolate negro con trozos de coco rallado', 'imagen' => null, 'reference' => "#12340123", 'category_id' => 1, 'stock' => 1700]
    ];

    public function seedProducts()
    {
        DB::table('products')->delete();
        foreach ($this->products as $product) {
            $p = new Product;
            $p->name = $product['name'];
            $p->price = ($product['price']);
            $p->discount = $product['discount'];
            $p->description_short = $product['description_short'];
            $p->description_large = $product['description_large'];
            $p->imagen = $product['imagen'];
            $p->reference = $product['reference'];
            $p->category_id = $product['category_id'];
            $p->stock = $product['stock'];
            $p->save();
        }
    }
    //Líneas de carrito
    private $cart_lines = [
        ['user_id' => 1, 'product_id' => 2, 'quantity' => 13],
        ['user_id' => 1, 'product_id' => 5, 'quantity' => 8],
        ['user_id' => 1, 'product_id' => 8, 'quantity' => 4],
        ['user_id' => 1, 'product_id' => 11, 'quantity' => 10],
        ['user_id' => 1, 'product_id' => 14, 'quantity' => 6],
        ['user_id' => 1, 'product_id' => 17, 'quantity' => 12],
        ['user_id' => 1, 'product_id' => 20, 'quantity' => 15],
        ['user_id' => 1, 'product_id' => 23, 'quantity' => 9],
        ['user_id' => 1, 'product_id' => 26, 'quantity' => 7],
        ['user_id' => 1, 'product_id' => 29, 'quantity' => 11],
        ['user_id' => 1, 'product_id' => 32, 'quantity' => 14],
        ['user_id' => 1, 'product_id' => 35, 'quantity' => 5],
        ['user_id' => 1, 'product_id' => 38, 'quantity' => 3],
        ['user_id' => 1, 'product_id' => 41, 'quantity' => 9],
        ['user_id' => 1, 'product_id' => 44, 'quantity' => 8],
        ['user_id' => 1, 'product_id' => 47, 'quantity' => 6],
        ['user_id' => 1, 'product_id' => 50, 'quantity' => 12],
        ['user_id' => 1, 'product_id' => 53, 'quantity' => 15],
        ['user_id' => 1, 'product_id' => 56, 'quantity' => 10],
        ['user_id' => 1, 'product_id' => 59, 'quantity' => 7],
        ['user_id' => 1, 'product_id' => 62, 'quantity' => 13],
        ['user_id' => 3, 'product_id' => 2, 'quantity' => 13],
        ['user_id' => 3, 'product_id' => 5, 'quantity' => 8],
        ['user_id' => 3, 'product_id' => 8, 'quantity' => 4],
        ['user_id' => 3, 'product_id' => 11, 'quantity' => 10],
        ['user_id' => 3, 'product_id' => 14, 'quantity' => 6],
        ['user_id' => 3, 'product_id' => 17, 'quantity' => 12],
        ['user_id' => 3, 'product_id' => 20, 'quantity' => 15],
        ['user_id' => 3, 'product_id' => 23, 'quantity' => 9],
        ['user_id' => 3, 'product_id' => 26, 'quantity' => 7],
        ['user_id' => 3, 'product_id' => 29, 'quantity' => 11],
    ];

    public function seedCart_lines()
    {
        DB::table('cart_lines')->delete();
        foreach ($this->cart_lines as $cart_line) {
            $cl = new Cart_line;
            $cl->user_id = $cart_line['user_id'];
            $cl->product_id = $cart_line['product_id'];
            $cl->quantity = $cart_line['quantity'];
            $cl->save();
        }
    }

    //Favoritos
    private $favourites = [
        ['user_id' => 1, 'product_id' => 20],
        ['user_id' => 1, 'product_id' => 23],
        ['user_id' => 1, 'product_id' => 26],
        ['user_id' => 1, 'product_id' => 29],
        ['user_id' => 1, 'product_id' => 32],
        ['user_id' => 1, 'product_id' => 35],
        ['user_id' => 1, 'product_id' => 38],
        ['user_id' => 1, 'product_id' => 41],
        ['user_id' => 1, 'product_id' => 44],
        ['user_id' => 1, 'product_id' => 47],
        ['user_id' => 1, 'product_id' => 50],
        ['user_id' => 1, 'product_id' => 53],
        ['user_id' => 1, 'product_id' => 56],
        ['user_id' => 1, 'product_id' => 59],
        ['user_id' => 1, 'product_id' => 62],
        ['user_id' => 3, 'product_id' => 20],
        ['user_id' => 3, 'product_id' => 23],
        ['user_id' => 3, 'product_id' => 26],
        ['user_id' => 3, 'product_id' => 29],
        ['user_id' => 3, 'product_id' => 32],
        ['user_id' => 3, 'product_id' => 35],
        ['user_id' => 3, 'product_id' => 38],
        ['user_id' => 3, 'product_id' => 41],
        ['user_id' => 3, 'product_id' => 44],
        ['user_id' => 3, 'product_id' => 47],
        ['user_id' => 3, 'product_id' => 50],
        ['user_id' => 3, 'product_id' => 53],
        ['user_id' => 3, 'product_id' => 56],
        ['user_id' => 3, 'product_id' => 59],
        ['user_id' => 3, 'product_id' => 62],
        ['user_id' => 7, 'product_id' => 20],
        ['user_id' => 7, 'product_id' => 23],
        ['user_id' => 7, 'product_id' => 26],
        ['user_id' => 7, 'product_id' => 29],
        ['user_id' => 7, 'product_id' => 32],
        ['user_id' => 7, 'product_id' => 35],
        ['user_id' => 7, 'product_id' => 38],
        ['user_id' => 7, 'product_id' => 41],
        ['user_id' => 7, 'product_id' => 44],
        ['user_id' => 7, 'product_id' => 47],
        ['user_id' => 7, 'product_id' => 50],
    ];

    public function seedFavourites()
    {
        DB::table('favourites')->delete();
        foreach ($this->favourites as $favourite) {
            $f = new Favourite;
            $f->user_id = $favourite['user_id'];
            $f->product_id = $favourite['product_id'];
            $f->save();
        }
    }

    //Comentarios
    private $comments = [
        ['user_id' => 1, 'product_id' => 24, 'comment' => 'El producto está muy bien, 100% recomendado', 'star' => 5, 'date' => '2021-12-23'],
        ['user_id' => 1, 'product_id' => 29, 'comment' => 'Buena calidad, me encantó', 'star' => 4, 'date' => '2021-12-24'],
        ['user_id' => 1, 'product_id' => 35, 'comment' => 'Buen servicio al cliente, envío rápido', 'star' => 4, 'date' => '2021-12-25'],
        ['user_id' => 1, 'product_id' => 38, 'comment' => 'Precio justo por la calidad del producto', 'star' => 4, 'date' => '2021-12-26'],
        ['user_id' => 1, 'product_id' => 42, 'comment' => 'El producto no cumplió mis expectativas', 'star' => 2, 'date' => '2021-12-27'],
        ['user_id' => 1, 'product_id' => 51, 'comment' => 'Excelente atención al cliente, muy satisfecho', 'star' => 5, 'date' => '2021-12-28'],
        ['user_id' => 1, 'product_id' => 53, 'comment' => 'Producto recibido en buen estado, gracias', 'star' => 4, 'date' => '2021-12-29'],
        ['user_id' => 1, 'product_id' => 60, 'comment' => 'Recomiendo este producto, muy útil', 'star' => 5, 'date' => '2021-12-30'],
        ['user_id' => 1, 'product_id' => 62, 'comment' => 'Buen producto, volvería a comprar', 'star' => 4, 'date' => '2021-12-31'],
        ['user_id' => 3, 'product_id' => 25, 'comment' => 'Excelente calidad, lo recomiendo', 'star' => 5, 'date' => '2022-01-01'],
        ['user_id' => 3, 'product_id' => 28, 'comment' => 'Muy satisfecho con mi compra', 'star' => 5, 'date' => '2022-01-02'],
        ['user_id' => 3, 'product_id' => 32, 'comment' => 'Producto recibido en perfectas condiciones', 'star' => 5, 'date' => '2022-01-03'],
        ['user_id' => 3, 'product_id' => 36, 'comment' => 'Buen precio, buena calidad', 'star' => 4, 'date' => '2022-01-04'],
        ['user_id' => 3, 'product_id' => 41, 'comment' => 'El producto no cumplió mis expectativas', 'star' => 2, 'date' => '2022-01-05'],
        ['user_id' => 3, 'product_id' => 47, 'comment' => 'Muy buen servicio al cliente, envío rápido', 'star' => 5, 'date' => '2022-01-06'],
        ['user_id' => 3, 'product_id' => 54, 'comment' => 'Producto de buena calidad, lo recomiendo', 'star' => 4, 'date' => '2022-01-07'],
        ['user_id' => 3, 'product_id' => 59, 'comment' => 'Atención al cliente excelente, muy satisfecho', 'star' => 5, 'date' => '2022-01-08'],
        ['user_id' => 3, 'product_id' => 62, 'comment' => 'Producto recibido según lo esperado', 'star' => 4, 'date' => '2022-01-09'],
        ['user_id' => 7, 'product_id' => 27, 'comment' => 'Buen servicio, gracias', 'star' => 4, 'date' => '2022-01-10'],
        ['user_id' => 7, 'product_id' => 31, 'comment' => 'Me encantó el producto, volvería a comprar', 'star' => 5, 'date' => '2022-01-11'],
        ['user_id' => 7, 'product_id' => 37, 'comment' => 'Producto de calidad, lo recomiendo', 'star' => 5, 'date' => '2022-01-12'],
        ['user_id' => 7, 'product_id' => 43, 'comment' => 'No quedé satisfecho con mi compra', 'star' => 2, 'date' => '2022-01-13'],
        ['user_id' => 7, 'product_id' => 48, 'comment' => 'Producto recibido en buen estado, gracias', 'star' => 4, 'date' => '2022-01-14'],
        ['user_id' => 7, 'product_id' => 52, 'comment' => 'Muy buen servicio, envío rápido', 'star' => 5, 'date' => '2022-01-15'],
        ['user_id' => 7, 'product_id' => 56, 'comment' => 'El producto superó mis expectativas', 'star' => 5, 'date' => '2022-01-16'],
        ['user_id' => 7, 'product_id' => 61, 'comment' => 'Buen producto, lo recomiendo', 'star' => 4, 'date' => '2022-01-17'],
        ['user_id' => 7, 'product_id' => 62, 'comment' => 'Excelente producto, volvería a comprar', 'star' => 5, 'date' => '2022-01-18'],
    ];

    public function seedComments()
    {
        DB::table('comments')->delete();
        foreach ($this->comments as $comment) {
            $com = new Comment;
            $com->user_id = $comment['user_id'];
            $com->product_id = $comment['product_id'];
            $com->comment = $comment['comment'];
            $com->star = $comment['star'];
            $com->date = $comment['date'];
            $com->save();
        }
    }

    //Pedidos
    private $orders = [
        ['user_id' => 1, 'date_order' => '2022-01-17', 'date_out' => '2022-01-19', 'date_delivered' => '2022-01-22', 'payment_method' => 'cash', 'state' => 'delivered', 'pay_state' => 'pagado', 'address' => 'Calle Zorrilla 1, 4C, 03690, Comunidad Valenciana, Alicante, San Vicente del Raspeig', 'clients_note' => 'enfrente del día, es una puerta roja', 'additional_cost' => 2.00, 'transaction_id' => '#323213'],
        [
            'user_id' => 3,
            'date_order' => '2022-01-20',
            'date_out' => '2022-01-22',
            'date_delivered' => '2022-01-25',
            'payment_method' => 'card_payment',
            'state' => 'delivered',
            'pay_state' => 'pagado',
            'address' => 'Calle del Mar, 15, 28033 Madrid',
            'clients_note' => 'Dejar en portería',
            'additional_cost' => 0.00,
            'transaction_id' => '#323214'
        ],
        [
            'user_id' => 7,
            'date_order' => '2022-01-22',
            'date_out' => '2022-01-24',
            'date_delivered' => '2022-01-28',
            'payment_method' => 'card_payment',
            'state' => 'delivered',
            'pay_state' => 'pagado',
            'address' => 'Av. de América, 4, 28028 Madrid',
            'clients_note' => 'Entregar en mano al portero',
            'additional_cost' => 3.50,
            'transaction_id' => '#323215'
        ],
        [
            'user_id' => 1,
            'date_order' => '2022-01-25',
            'date_out' => '2022-01-27',
            'date_delivered' => '2022-01-30',
            'payment_method' => 'cash',
            'state' => 'delivered',
            'pay_state' => 'pagado',
            'address' => 'Calle Mayor, 10, 46001 Valencia',
            'clients_note' => 'Dejar en buzón',
            'additional_cost' => 1.00,
            'transaction_id' => '#323216'
        ],
        [
            'user_id' => 3,
            'date_order' => '2022-02-02',
            'date_out' => '2022-02-04',
            'date_delivered' => '2022-02-07',
            'payment_method' => 'cash',
            'state' => 'delivered',
            'pay_state' => 'pagado',
            'address' => 'Calle Mayor, 5, 46002 Valencia',
            'clients_note' => 'Dejar en buzón',
            'additional_cost' => 1.50,
            'transaction_id' => '#323218'
        ],
        [
            'user_id' => 1,
            'date_order' => '2022-02-05',
            'date_out' => '2022-02-07',
            'date_delivered' => '2022-02-10',
            'payment_method' => 'card_payment',
            'state' => 'delivered',
            'pay_state' => 'pagado',
            'address' => 'Calle Atocha, 15, 28012 Madrid',
            'clients_note' => 'Entregar en portería',
            'additional_cost' => 2.00,
            'transaction_id' => '#323219'
        ],
        [
            'user_id' => 7,
            'date_order' => '2022-02-06',
            'date_out' => '2022-02-08',
            'date_delivered' => '2022-02-11',
            'payment_method' => 'cash',
            'state' => 'delivered',
            'pay_state' => 'pagado',
            'address' => 'Av. Diagonal, 20, 08019 Barcelona',
            'clients_note' => 'Entregar en mano al portero',
            'additional_cost' => 0.00,
            'transaction_id' => '#323220'
        ],    [
            'user_id' => 3,
            'date_order' => '2022-02-09',
            'date_out' => '2022-02-11',
            'date_delivered' => '2022-02-14',
            'payment_method' => 'card_payment',
            'state' => 'delivered',
            'pay_state' => 'pagado',
            'address' => 'Carrer de Balmes, 50, 08007 Barcelona',
            'clients_note' => 'Dejar en buzón',
            'additional_cost' => 1.50,
            'transaction_id' => '#323221'
        ],
        [
            'user_id' => 1,
            'date_order' => '2022-02-10',
            'date_out' => '2022-02-12',
            'date_delivered' => '2022-02-15',
            'payment_method' => 'cash',
            'state' => 'delivered',
            'pay_state' => 'pagado',
            'address' => 'Calle Gran Vía, 30, 28013 Madrid',
            'clients_note' => 'Entregar en mano al destinatario',
            'additional_cost' => 0.00,
            'transaction_id' => '#323222'
        ],
        [
            'user_id' => 7,
            'date_order' => '2022-02-13',
            'date_out' => '2022-02-15',
            'date_delivered' => '2022-02-18',
            'payment_method' => 'card_payment',
            'state' => 'delivered',
            'pay_state' => 'pagado',
            'address' => 'Calle de Serrano, 100, 28006 Madrid',
            'clients_note' => 'Entregar en portería',
            'additional_cost' => 2.00,
            'transaction_id' => '#323223'
        ],
        [
            'user_id' => 3,
            'date_order' => '2022-02-14',
            'date_out' => '2022-02-16',
            'date_delivered' => '2022-02-19',
            'payment_method' => 'cash',
            'state' => 'delivered',
            'pay_state' => 'pagado',
            'address' => 'Plaça de Catalunya, 08002 Barcelona',
            'clients_note' => 'Dejar en buzón',
            'additional_cost' => 0.00,
            'transaction_id' => '#323224'
        ],

    ];

    public function seedOrders()
    {
        DB::table('orders')->delete();
        foreach ($this->orders as $order) {
            $o = new Order;
            $o->user_id = $order['user_id'];
            $o->date_order = $order['date_order'];
            $o->date_out = $order['date_out'];
            $o->date_delivered = $order['date_delivered'];
            $o->payment_method = $order['payment_method'];
            $o->state = $order['state'];
            $o->pay_state = $order['pay_state'];
            $o->address = $order['address'];
            $o->clients_note = $order['clients_note'];
            $o->additional_cost = $order['additional_cost'];
            $o->transaction_id = $order['transaction_id'];
            $o->save();
        }
    }
    //Productos de los pedidos
    private $order_products = [
        ['order_id' => 1, 'product_id' => 4, 'quantity' => 12, 'price' => 12.5],
        ['order_id' => 2, 'product_id' => 8, 'quantity' => 5, 'price' => 11.5],
        ['order_id' => 3, 'product_id' => 15, 'quantity' => 9, 'price' => 10.5],
        ['order_id' => 4, 'product_id' => 21, 'quantity' => 7, 'price' => 20.5],
        ['order_id' => 5, 'product_id' => 28, 'quantity' => 3, 'price' => 8.4],
        ['order_id' => 6, 'product_id' => 32, 'quantity' => 10, 'price' => 1.3],
        ['order_id' => 7, 'product_id' => 38, 'quantity' => 6, 'price' => 2.2],
        ['order_id' => 8, 'product_id' => 42, 'quantity' => 14, 'price' => 4.8],
        ['order_id' => 9, 'product_id' => 48, 'quantity' => 8, 'price' => 7.3],
        ['order_id' => 10, 'product_id' => 55, 'quantity' => 11, 'price' => 16.8],
        ['order_id' => 11, 'product_id' => 61, 'quantity' => 4, 'price' => 5.1],
    ];

    public function seedOrder_products()
    {
        DB::table('order_products')->delete();
        foreach ($this->order_products as $order_product) {
            $op = new Order_Product;
            $op->order_id = $order_product['order_id'];
            $op->product_id = $order_product['product_id'];
            $op->quantity = $order_product['quantity'];
            $op->price = $order_product['price'];
            $op->save();
        }
    }


    public function run(): void
    {
        self::seedUsers();
        $this->command->info("Tabla usuarios inicializada con datos!");

        self::seedCategories();
        $this->command->info("Tabla categorias inicializada con datos!");

        self::seedProducts();
        $this->command->info("Tabla productos inicializada con datos!");

        self::seedCart_lines();
        $this->command->info("Tabla línea carrito inicializada con datos!");

        self::seedFavourites();
        $this->command->info("Tabla favoritos inicializada con datos!");

        self::seedComments();
        $this->command->info("Tabla comentarios inicializada con datos!");

        self::seedOrders();
        $this->command->info("Tabla pedidos inicializada con datos!");

        self::seedOrder_products();
        $this->command->info("Tabla productos de los pedidos inicializada con datos!");

    }
}
