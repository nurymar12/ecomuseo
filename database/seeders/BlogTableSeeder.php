<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;


class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogsData = [
            [
                'title' => 'Ruta del Huayruro: Tesoros de la Selva',
                'content' => '#   El Misterioso Mundo del Huayruro: Un Tesoro Amazónico

                El Huayruro es más que una simple semilla en la rica biodiversidad de la Amazonía; es un símbolo cultural, un amuleto de buena suerte y una pieza central en la interpretación de la naturaleza por parte de las comunidades locales. A continuación, exploraremos la fascinante historia y los usos de esta peculiar semilla.

                ## Historia y Significado

                El Huayruro (Ormosia spp.) es conocido por sus distintivas semillas rojas y negras, que se encuentran en el corazón de la selva amazónica. Estas semillas han sido utilizadas por generaciones en las culturas indígenas para una variedad de propósitos, desde adornos hasta componentes en rituales espirituales.

                ### Significado Cultural

                - **Amuleto de Suerte:** Se cree que llevar consigo las semillas de Huayruro atrae la buena suerte y protege contra las energías negativas.
                - **Símbolo de Dualidad:** El contraste entre el rojo y el negro de las semillas simboliza la dualidad de la vida, la coexistencia del bien y el mal, y el equilibrio entre las fuerzas opuestas.

                ## Usos y Aplicaciones

                Las semillas de Huayruro no solo son significativas en términos culturales, sino que también tienen aplicaciones prácticas en la vida cotidiana de las comunidades amazónicas.

                - **Joyería y Adornos:** Debido a su atractivo natural, estas semillas se utilizan comúnmente en la creación de joyería artesanal, como collares, pulseras y aretes.
                - **Elementos Decorativos:** Además de su uso en joyería, las semillas de Huayruro se emplean en la decoración de diversos objetos, aportando un toque único y significativo a artículos cotidianos y artefactos ceremoniales.
                ![](data:image/jpeg;base64,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)

                ## Conservación e Interpretación

                La preservación del Huayruro y su entorno natural es esencial para las comunidades indígenas y para la biodiversidad de la Amazonía. Los esfuerzos de conservación buscan proteger no solo la planta misma, sino también el conocimiento tradicional que rodea su uso y significado.

                - **Educación y Sensibilización:** Informar sobre la importancia del Huayruro y su hábitat ayuda a fomentar el respeto y la protección de los ecosistemas amazónicos.
                - **Turismo Responsable:** La promoción de un turismo que respete la naturaleza y las culturas locales puede contribuir a la conservación del Huayruro y su entorno.

                ---

                El Huayruro es un pequeño pero poderoso recordatorio de la riqueza cultural y natural de la Amazonía. A través de la apreciación y preservación de esta semilla, podemos aprender lecciones valiosas sobre la importancia de mantener el equilibrio con la naturaleza y valorar las tradiciones que nos conectan con nuestro entorno.',
                'status' => 'approved',
                'author_id' => 1, // Asegúrate de que este ID de usuario exista.
                'components' => [2], // IDs de los componentes para este blog
            ],
            [
                'title' => 'Las Abejas Meliponas y la Interpretación de Nuestros Ecosistemas',
                'content' => '# Las Abejas Meliponas y la Interpretación de Nuestros Ecosistemas \nLas Abejas Meliponas, también conocidas como abejas sin aguijón, juegan un papel crucial en la biodiversidad de nuestros ecosistemas, especialmente en las regiones tropicales. A través de su labor de polinización, estas abejas no solo contribuyen a la reproducción de plantas, sino que también ofrecen una ventana única a la comprensión de conceptos clave como la biodiversidad, los ecosistemas, las cadenas alimenticias y los ciclos biogeoquímicos.
                ![](https://scontent-lim1-1.xx.fbcdn.net/v/t39.30808-6/426406824_122124259892144048_7477040608248446991_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=a73e89&_nc_ohc=0YVSQmG29ZwAX-TdbSl&_nc_ht=scontent-lim1-1.xx&oh=00_AfDdoa8BJ9hFg0XOqjOt5ln2y7NNPMBGpnhfGfRilNMRNg&oe=65E6D582)

                ## Importancia de las Abejas Meliponas

                ### Polinización y Biodiversidad

                - **Polinización:** Las Abejas Meliponas son polinizadoras eficientes de muchas especies de plantas, algunas de las cuales dependen exclusivamente de estas abejas para su reproducción.
                - **Conservación de la Biodiversidad:** Al polinizar plantas, estas abejas promueven la diversidad genética y el mantenimiento de ecosistemas saludables.

                ### Sostenibilidad y Producción de Miel

                - **Miel Única:** Producen una miel altamente valorada por sus propiedades medicinales y nutricionales, distinta de la miel de abejas con aguijón.
                - **Prácticas Sostenibles:** La apicultura de Meliponas fomenta prácticas agrícolas sostenibles que respetan el equilibrio de los ecosistemas locales.

                ## Interpretación de Ecosistemas a Través de las Abejas Meliponas

                ### Ecosistemas y Cadenas Alimenticias

                Las Abejas Meliponas nos ofrecen una lente a través de la cual podemos observar la interdependencia de los seres vivos dentro de los ecosistemas. Su rol en la polinización es un eslabón vital en las cadenas alimenticias, asegurando la reproducción de una amplia gama de plantas que sirven como alimento para otros organismos.

                ### Ciclos Biogeoquímicos

                - **Ciclo del Carbono:** Al promover la reproducción de plantas, las Abejas Meliponas juegan un papel en el secuestro de carbono, ya que las plantas utilizan el dióxido de carbono para la fotosíntesis.
                - **Ciclo de Nutrientes:** La actividad de las abejas también influye en la dispersión de semillas y en la fertilización del suelo, contribuyendo a los ciclos de nutrientes esenciales para la salud del ecosistema.

                ## Desafíos y Conservación

                Las Abejas Meliponas enfrentan amenazas como la deforestación, el cambio climático y el uso de pesticidas. Es crucial implementar medidas de conservación que protejan estas especies y sus hábitats para mantener los servicios ecológicos que proporcionan.
                ![](https://scontent-lim1-1.xx.fbcdn.net/v/t39.30808-6/409079929_122128046006144048_8524118273417418182_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=a73e89&_nc_ohc=qWe75-H0kwsAX-Y_1Ht&_nc_ht=scontent-lim1-1.xx&oh=00_AfDKxPMQnErJrcGYeCH2hhJa2wokgbdXkGiEKs1-xgZRAw&oe=65E7B49C)

                ### Estrategias de Conservación

                - **Educación Ambiental:** Sensibilizar sobre la importancia de las Abejas Meliponas y su papel en los ecosistemas.
                - **Prácticas Agrícolas Sostenibles:** Fomentar la agricultura orgánica y otras prácticas que reduzcan el impacto negativo en los hábitats de las abejas.
                - **Protección de Hábitats:** Implementar políticas de conservación que protejan los ecosistemas naturales de estas abejas.

                ---

                Las Abejas Meliponas son embajadoras de la complejidad y riqueza de nuestros ecosistemas. A través de la interpretación de su comportamiento y rol ecológico, podemos obtener una comprensión más profunda de la biodiversidad, los ecosistemas, las cadenas alimenticias y los ciclos biogeoquímicos. Proteger a estas abejas y a sus hábitats es esencial para preservar la salud de nuestro planeta y asegurar un futuro sostenible para las próximas generaciones.',
                'status' => 'pending',
                'author_id' => 2, // Asegúrate de que este ID de usuario exista.
                'components' => [1,4], // IDs de los componentes para este blog
            ],
            [
                'title' => 'Gigantes Verdes: El Legado de las Cashaponas',
                'content' => '# Conoce a las Cashaponas: Mis Amigas del Bosque

                Hoy tengo el inmenso placer de presentarles a unas amigas muy especiales que habitan en el corazón de la selva: las Cashaponas. Estas criaturas, aunque menos conocidas, juegan un papel fundamental en el equilibrio y la salud de nuestros ecosistemas. Acompáñenme en este viaje para descubrir la magia y la importancia de estas maravillosas amigas.

                ![](https://scontent-lim1-1.xx.fbcdn.net/v/t39.30808-6/424602279_122124562478144048_3960897960414457707_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=a73e89&_nc_ohc=XGiW6HVEzJ8AX_fptr6&_nc_ht=scontent-lim1-1.xx&oh=00_AfCjep9vAZd8U9t_oK_aojiibRBCNhn2clGYevcMrGhNLw&oe=65E84451)

                ## ¿Quiénes son las Cashaponas?

                Las Cashaponas son árboles majestuosos que se elevan con orgullo en la Amazonía, formando parte esencial de este intrincado ecosistema. Son seres vivos que, con su sola presencia, cuentan historias de resiliencia, belleza y una interconexión profunda con la naturaleza que los rodea.

                ### Guardianes del Bosque

                Estos árboles no son solo organismos fotosintéticos; son guardianes del bosque, protectores de la biodiversidad que albergan una vasta cantidad de vida en sus ramas y bajo sus raíces. Cada Cashapona es un hogar, un refugio para especies de aves, insectos, y otras plantas que dependen de ellas para sobrevivir.

                ### Arquitectos de la Selva

                Las Cashaponas son verdaderos arquitectos de la selva, ayudando a moldear el paisaje y a mantener la salud del suelo. Sus raíces profundas combaten la erosión y sus hojas caídas enriquecen el suelo con nutrientes esenciales, permitiendo que la vida florezca en su entorno.

                ## La Importancia de las Cashaponas

                ### Biodiversidad y Equilibrio Ecológico

                Al ser parte fundamental de su ecosistema, las Cashaponas contribuyen a la biodiversidad y al equilibrio ecológico de la selva. Su existencia asegura que múltiples especies puedan coexistir, creando un entorno rico y diverso indispensable para la salud del planeta.

                ### Amigas del Clima

                Además, estas amigas del bosque son grandes aliadas en la lucha contra el cambio climático. Al absorber dióxido de carbono y producir oxígeno, las Cashaponas juegan un rol crucial en la purificación del aire que respiramos y en la regulación del clima global.

                ## Un Llamado a la Acción

                A pesar de su importancia, las Cashaponas enfrentan amenazas constantes debido a la deforestación, la explotación de recursos naturales y el cambio climático. Es nuestro deber proteger a estas amigas del bosque, asegurando su conservación para las generaciones futuras.

                ### Cómo Podemos Ayudar

                - **Educación y Conciencia:** Difundir la palabra sobre la importancia de las Cashaponas y los ecosistemas que sostienen.
                - **Apoyo a la Conservación:** Participar y apoyar proyectos de conservación que protejan estas áreas vitales.
                - **Prácticas Sostenibles:** Adoptar prácticas sostenibles en nuestra vida diaria para reducir nuestro impacto en el planeta.

                ---

                Las Cashaponas son más que simples árboles; son amigas que nos enseñan la importancia de vivir en armonía con la naturaleza. Al protegerlas, no solo salvaguardamos un componente crucial de los ecosistemas tropicales, sino que también protegemos nuestra propia supervivencia. Juntos, podemos asegurar que las Cashaponas y la maravillosa biodiversidad que representan prosperen para el deleite y bienestar de las futuras generaciones.',
                'status' => 'rejected',
                'author_id' => 3, // Asegúrate de que este ID de usuario exista.
                'components' => [3], // IDs de los componentes para este blog
            ],
            // Puedes agregar más blogs aquí
        ];

        foreach ($blogsData as $blogData) {
            // Crear el blog
            $blog = Blog::create([
                'title' => $blogData['title'],
                'content' => $blogData['content'],
                'status' => $blogData['status'],
                'author_id' => $blogData['author_id'],

            ]);

            // Relacionar los componentes específicos con el blog creado
            $blog->components()->attach($blogData['components']);
        };
    }
}
