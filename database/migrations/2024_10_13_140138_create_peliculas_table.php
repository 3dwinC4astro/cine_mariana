<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePeliculasTable extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE TABLE peliculas (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(255) NOT NULL,
                horarios json,
                clasificacion VARCHAR(255),
                genero VARCHAR(255) NOT NULL,
                animacion VARCHAR(255) NOT NULL,
                trailer VARCHAR(255),
                imagen MEDIUMBLOB,
                created_at TIMESTAMP NULL,
                updated_at TIMESTAMP NULL
            )
        ");
    }

    public function down()
    {
        Schema::dropIfExists('peliculas');
    }
}
