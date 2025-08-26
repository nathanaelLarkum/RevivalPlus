<?php

namespace Database\Seeders;

use App\Models\Denomination;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DenominationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $denominations = [
            'Catholic Church' => 'The largest Christian church, led by the Pope in Rome. It emphasizes a hierarchical structure, seven sacraments (especially the Eucharist), and veneration of the Virgin Mary and saints.',
            'Protestantism (as a whole)' => 'A broad movement of Christian denominations that separated from the Catholic Church during the Reformation. It generally emphasizes salvation by grace through faith alone, the Bible as the sole authority for faith, and the priesthood of all believers.',
            'Pentecostalism (as a movement)' => 'A charismatic movement within Christianity that emphasizes a personal experience with God and the direct work of the Holy Spirit. Key beliefs include divine healing, baptism in the Holy Spirit, and speaking in tongues.',
            'Eastern Orthodox Church' => 'One of the three main branches of Christianity, rooted in Eastern Europe and the Middle East. It split from the Catholic Church in 1054 and emphasizes a mystical union with God, icons in worship, and a decentralized authority structure.',
            'Anglicanism' => 'A Western Christian tradition that originated from the Church of England\'s split from the Catholic Church. It is often described as a "middle way" (via media) between Protestantism and Catholicism, blending Protestant doctrines with liturgical practices.',
            'Baptist Churches' => 'A Protestant denomination that emphasizes "believer\'s baptism" by full immersion, meaning baptism is only for those who have professed faith in Jesus Christ. They are congregationally governed and believe in the Bible as the final authority.',
            'Oriental Orthodox Church' => 'A family of Christian churches that broke away after the Council of Chalcedon in 451 AD due to Christological differences. It includes the Coptic, Ethiopian, and Armenian churches, among others.',
            'Methodist Churches' => 'A family of Protestant churches that grew out of the teachings of John Wesley. They emphasize personal holiness, social justice, and evangelism, with a focus on God\'s grace and a structured church hierarchy.',
            'Nondenominational Christianity' => 'A movement of churches that are not affiliated with any formal denomination. They are independent and self-governing, with diverse worship styles and beliefs, though they often lean evangelical and charismatic.',
            'Assemblies of God' => 'A prominent Pentecostal Christian denomination that places strong emphasis on the baptism of the Holy Spirit, speaking in tongues as evidence of the baptism, and divine healing.',
            'United Methodist Church' => 'A major mainline Protestant denomination in the Methodist tradition, known for its emphasis on social action, global mission work, and a connectional church structure.',
            'Presbyterian Churches' => 'A family of Protestant churches that emerged from the Calvinist tradition of the Reformation. They are governed by a system of elders (presbyters) and emphasize the sovereignty of God and the authority of scripture.',
            'Churches of Christ' => 'A fellowship of Christian congregations that originated from the American Restoration Movement. They seek to restore the church to its first-century practices, rejecting formal creeds and often worshiping with a cappella singing.',
            'New Apostolic Church' => 'An international Christian church with a millenarian theology. It believes in a modern-day apostleship and places a strong emphasis on the Holy Spirit and the Second Coming of Christ.',
            'Coptic Orthodox Church of Alexandria' => 'The largest Christian denomination in Egypt and part of the Oriental Orthodox family. It is known for its ancient liturgical traditions, monasticism, and deep historical roots in the region.',
            'Ethiopian Orthodox Tewahedo Church' => 'The largest of the Oriental Orthodox churches, with a significant following in Ethiopia. It has unique traditions, including some Old Testament practices, and a rich liturgical life conducted in the ancient Ge\'ez language.',
            'Maronite Church' => 'An Eastern Catholic Church in full communion with the Pope in Rome, but with its own distinct liturgical and hierarchical traditions. It is centered in Lebanon.',
            'The Church of Pentecost' => 'A large, fast-growing Pentecostal denomination originating in Ghana. It is known for its evangelistic fervor, strong emphasis on missions, and a hierarchical structure.',
            'Armenian Apostolic Church' => 'One of the oldest Christian traditions, tracing its origins to the apostles Thaddeus and Bartholomew. It is part of the Oriental Orthodox family and was the first state church in history.',
            'Southern Baptist Convention' => 'The largest Baptist denomination in the United States, known for its conservative theology, strong focus on evangelism and missions, and an emphasis on the autonomy of individual congregations.',
            'Church of God in Christ' => 'A prominent and historically African-American Pentecostal denomination. It is known for its vibrant worship, emphasis on the Holy Spirit, and a strong global presence.',
            'Evangelical Lutheran Church in America' => 'The largest Lutheran denomination in the United States, formed by a merger of three Lutheran bodies. It is known for its commitment to social justice and its more progressive stance on social issues compared to other Lutheran groups.',
            'African Methodist Episcopal Church' => 'A Christian denomination in the Methodist tradition, founded in the late 18th century by African Americans seeking freedom from racial discrimination in worship. It emphasizes social and spiritual development.',
            'Universal Church of the Kingdom of God' => 'A Brazilian-based Pentecostal denomination known for its focus on prosperity theology, divine healing, and a large global footprint.',
            'The Episcopal Church (USA)' => 'The U.S. branch of the global Anglican Communion. It is known for its liturgical worship, social activism, and generally progressive theology.',
            'Presbyterian Church (USA)' => 'The largest Presbyterian denomination in the United States. It is a mainline Protestant church with a history of social reform and an emphasis on education and missions.',
            'Christian Church (Disciples of Christ)' => 'A mainline Protestant denomination that emerged from the Restoration Movement. It advocates for Christian unity and congregational self-governance.',
            'United Church of Christ' => 'A mainline Protestant denomination in the United States, formed from a merger of several different traditions. It is known for its commitment to social justice and a progressive, inclusive theology.',
            'Church of the Nazarene' => 'A Protestant denomination in the Wesleyan-Holiness tradition. It emphasizes the doctrine of "entire sanctification," a work of grace after conversion that cleanses a believer from original sin.',
            'Independent Catholicism' => 'A movement of clergy and laity who identify as Catholic and claim apostolic succession but are not in communion with the Roman Catholic Church. They often have different views on issues like married priests or the ordination of women.',
            'Christian and Missionary Alliance' => 'A global missions-focused evangelical denomination. It was founded as a cross-denominational society and evolved into a church-planting movement focused on taking the gospel to unreached people groups.',
            'Plymouth Brethren' => 'A conservative, evangelical Christian movement that originated in the 19th century. They emphasize the priesthood of all believers, simple worship, and a non-clerical structure, with meetings often centered on Bible study and communion.',
            'Mennonite Churches' => 'A family of Christian churches in the Anabaptist tradition. They are known for their emphasis on pacifism, community, simple living, and a strict adherence to the teachings of Jesus.',
            'The Salvation Army' => 'An evangelical Christian church and international charitable organization. It is known for its mission to address both spiritual and physical needs, with a paramilitary-style structure and an emphasis on social ministry.',
            'Church of God (Cleveland, Tennessee)' => 'A Pentecostal denomination that originated from the Holiness movement. It is known for its focus on the gifts of the Holy Spirit, divine healing, and a structured, hierarchical governance.',
            'Anabaptism' => 'A radical Protestant Reformation tradition that emphasizes adult "believer\'s baptism," pacifism, and the separation of church and state.',
            'Christian Congregation in Brazil' => 'A large, finished-work Pentecostal denomination in Brazil. It is known for its distinct liturgy, use of an orchestra in worship, and a strong emphasis on lay leadership.',
            'International Pentecostal Holiness Church' => 'A Pentecostal denomination with Wesleyan-Holiness roots. It emphasizes a personal relationship with God, divine healing, and a global mission to spread the gospel.',
            'Progressive National Baptist Convention' => 'A historically African-American Baptist denomination that split from the National Baptist Convention, USA, Inc., over issues of civil rights and organizational control. It is a leading voice for social justice.',
            'African Methodist Episcopal Zion Church' => 'A historically African-American Methodist denomination that separated from the Methodist Episcopal Church in New York City due to racial discrimination. It is known as the "Freedom Church" for its role in the abolitionist movement.',
            'National Baptist Convention, USA, Inc.' => 'The largest historically African-American Christian denomination in the United States. It is a Baptist convention known for its focus on missions, education, and social issues.',
        ];

        foreach ($denominations as $name => $description) {
            Denomination::firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'description' => $description,
                ]
            );
        }
    }
}
