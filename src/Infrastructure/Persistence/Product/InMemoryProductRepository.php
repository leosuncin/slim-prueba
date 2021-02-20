<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Product;


use App\Domain\Product\Product;
use App\Domain\Product\ProductNotFoundException;
use App\Domain\Product\ProductRepository;

/**
 * Class In Memory Product Repository
 * @package App\Infrastructure\Persistence\Product
 */
class InMemoryProductRepository implements ProductRepository
{
    /**
     * @var Product[]
     */
    private $products;

    /**
     * InMemoryProductRepository constructor.
     * @param Product[]|null $products
     */
    public function __construct(array $products = null)
    {
        $this->products = $products ?? [
                1 => new Product(
                    1,
                    "Fjallraven - Foldsack No. 1 Backpack, Fits 15 Laptops",
                    "Your perfect pack for everyday use and walks in the forest. Stash your laptop (up to 15 inches) in the padded sleeve, your everyday",
                    "https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg",
                    109.95
                ),
                2 => new Product(
                    2,
                    "Mens Casual Premium Slim Fit T-Shirts ",
                    "Slim-fitting style, contrast raglan long sleeve, three-button henley placket, light weight & soft fabric for breathable and comfortable wearing. And Solid stitched shirts with round neck made for durability and a great fit for casual fashion wear and diehard baseball fans. The Henley style round neckline includes a three-button placket.",
                    "https://fakestoreapi.com/img/71-3HjGNDUL._AC_SY879._SX._UX._SY._UY_.jpg",
                    22.3
                ),
                3 => new Product(
                    3,
                    "Mens Cotton Jacket",
                    "great outerwear jackets for Spring/Autumn/Winter, suitable for many occasions, such as working, hiking, camping, mountain/rock climbing, cycling, traveling or other outdoors. Good gift choice for you or your family member. A warm hearted love to Father, husband or son in this thanksgiving or Christmas Day.",
                    "https://fakestoreapi.com/img/71li-ujtlUL._AC_UX679_.jpg",
                    55.99
                ),
                4 => new Product(
                    4,
                    "Mens Casual Slim Fit",
                    "The color could be slightly different between on the screen and in practice. / Please note that body builds vary by person, therefore, detailed size information should be reviewed below on the product description.",
                    "https://fakestoreapi.com/img/71YXzeOuslL._AC_UY879_.jpg",
                    15.99
                ),
                5 => new Product(
                    5,
                    "John Hardy Women's Legends Naga Gold & Silver Dragon Station Chain Bracelet",
                    "From our Legends Collection, the Naga was inspired by the mythical water dragon that protects the ocean's pearl. Wear facing inward to be bestowed with love and abundance, or outward for protection.", "https://fakestoreapi.com/img/71pWzhdJNwL._AC_UL640_QL65_ML3_.jpg", 695),
                6 => new Product(
                    6,
                    "Solid Gold Petite Micropave ",
                    "Satisfaction Guaranteed. Return or exchange any order within 30 days.Designed and sold by Hafeez Center in the United States. Satisfaction Guaranteed. Return or exchange any order within 30 days.",
                    "https://fakestoreapi.com/img/61sbMiUnoGL._AC_UL640_QL65_ML3_.jpg",
                    168
                ),
                7 => new Product(
                    7,
                    "White Gold Plated Princess",
                    "Classic Created Wedding Engagement Solitaire Diamond Promise Ring for Her. Gifts to spoil your love more for Engagement, Wedding, Anniversary, Valentine's Day...",
                    "https://fakestoreapi.com/img/71YAIFU48IL._AC_UL640_QL65_ML3_.jpg",
                    9.99
                ),
                8 => new Product(
                    8,
                    "Pierced Owl Rose Gold Plated Stainless Steel Double",
                    "Rose Gold Plated Double Flared Tunnel Plug Earrings. Made of 316L Stainless Steel",
                    "https://fakestoreapi.com/img/51UDEzMJVpL._AC_UL640_QL65_ML3_.jpg",
                    10.99
                ),
                9 => new Product(
                    9,
                    "WD 2TB Elements Portable External Hard Drive - USB 3.0 ",
                    "USB 3.0 and USB 2.0 Compatibility Fast data transfers Improve PC Performance High Capacity; Compatibility Formatted NTFS for Windows 10, Windows 8.1, Windows 7; Reformatting may be required for other operating systems; Compatibility may vary depending on user’s hardware configuration and operating system",
                    "https://fakestoreapi.com/img/61IBBVJvSDL._AC_SY879_.jpg",
                    64
                ),
                10 => new Product(
                    10,
                    "SanDisk SSD PLUS 1TB Internal SSD - SATA III 6 Gb/s",
                    "Easy upgrade for faster boot up, shutdown, application load and response (As compared to 5400 RPM SATA 2.5” hard drive; Based on published specifications and internal benchmarking tests using PCMark vantage scores) Boosts burst write performance, making it ideal for typical PC workloads The perfect balance of performance and reliability Read/write speeds of up to 535MB/s/450MB/s (Based on internal testing; Performance may vary depending upon drive capacity, host device, OS and application.)",
                    "https://fakestoreapi.com/img/61U7T1koQqL._AC_SX679_.jpg",
                    109
                ),
                11 => new Product(
                    11,
                    "Silicon Power 256GB SSD 3D NAND A55 SLC Cache Performance Boost SATA III 2.5",
                    "3D NAND flash are applied to deliver high transfer speeds Remarkable transfer speeds that enable faster bootup and improved overall system performance. The advanced SLC Cache Technology allows performance boost and longer lifespan 7mm slim design suitable for Ultrabooks and Ultra-slim notebooks. Supports TRIM command, Garbage Collection technology, RAID, and ECC (Error Checking & Correction) to provide the optimized performance and enhanced reliability.",
                    "https://fakestoreapi.com/img/71kWymZ+c+L._AC_SX679_.jpg",
                    109
                ),
                12 => new Product(
                    12,
                    "WD 4TB Gaming Drive Works with Playstation 4 Portable External Hard Drive",
                    "Expand your PS4 gaming experience, Play anywhere Fast and easy, setup Sleek design with high capacity, 3-year manufacturer's limited warranty",
                    "https://fakestoreapi.com/img/61mtL65D4cL._AC_SX679_.jpg",
                    114
                ),
                13 => new Product(
                    13,
                    "Acer SB220Q bi 21.5 inches Full HD (1920 x 1080) IPS Ultra-Thin",
                    "21. 5 inches Full HD (1920 x 1080) widescreen IPS display And Radeon free Sync technology. No compatibility for VESA Mount Refresh Rate: 75Hz - Using HDMI port Zero-frame design | ultra-thin | 4ms response time | IPS panel Aspect ratio - 16: 9. Color Supported - 16. 7 million colors. Brightness - 250 nit Tilt angle -5 degree to 15 degree. Horizontal viewing angle-178 degree. Vertical viewing angle-178 degree 75 hertz",
                    "https://fakestoreapi.com/img/81QpkIctqPL._AC_SX679_.jpg",
                    599
                ),
                14 => new Product(
                    14,
                    "Samsung 49-Inch CHG90 144Hz Curved Gaming Monitor (LC49HG90DMNXZA) – Super Ultrawide Screen QLED ",
                    "49 INCH SUPER ULTRAWIDE 32:9 CURVED GAMING MONITOR with dual 27 inch screen side by side QUANTUM DOT (QLED) TECHNOLOGY, HDR support and factory calibration provides stunningly realistic and accurate color and contrast 144HZ HIGH REFRESH RATE and 1ms ultra fast response time work to eliminate motion blur, ghosting, and reduce input lag",
                    "https://fakestoreapi.com/img/81Zt42ioCgL._AC_SX679_.jpg",
                    999.99
                ),
                15 => new Product(
                    15,
                    "BIYLACLESEN Women's 3-in-1 Snowboard Jacket Winter Coats",
                    "Note:The Jackets is US standard size, Please choose size as your usual wear Material: 100% Polyester; Detachable Liner Fabric: Warm Fleece. Detachable Functional Liner: Skin Friendly, Lightweigt and Warm.Stand Collar Liner jacket, keep you warm in cold weather. Zippered Pockets: 2 Zippered Hand Pockets, 2 Zippered Pockets on Chest (enough to keep cards or keys)and 1 Hidden Pocket Inside.Zippered Hand Pockets and Hidden Pocket keep your things secure. Humanized Design: Adjustable and Detachable Hood and Adjustable cuff to prevent the wind and water,for a comfortable fit. 3 in 1 Detachable Design provide more convenience, you can separate the coat and inner as needed, or wear it together. It is suitable for different season and help you adapt to different climates",
                    "https://fakestoreapi.com/img/51Y5NI-I5jL._AC_UX679_.jpg",
                    56.99
                ),
                16 => new Product(
                    16,
                    "Lock and Love Women's Removable Hooded Faux Leather Moto Biker Jacket",
                    "100% POLYURETHANE(shell) 100% POLYESTER(lining) 75% POLYESTER 25% COTTON (SWEATER), Faux leather material for style and comfort / 2 pockets of front, 2-For-One Hooded denim style faux leather jacket, Button detail on waist / Detail stitching at sides, HAND WASH ONLY / DO NOT BLEACH / LINE DRY / DO NOT IRON",
                    "https://fakestoreapi.com/img/81XH0e8fefL._AC_UY879_.jpg",
                    29.95
                ),
                17 => new Product(
                    17,
                    "Rain Jacket Women Windbreaker Striped Climbing Raincoats",
                    "Lightweight perfet for trip or casual wear---Long sleeve with hooded, adjustable drawstring waist design. Button and zipper front closure raincoat, fully stripes Lined and The Raincoat has 2 side pockets are a good size to hold all kinds of things, it covers the hips, and the hood is generous but doesn't overdo it.Attached Cotton Lined Hood with Adjustable Drawstrings give it a real styled look.",
                    "https://fakestoreapi.com/img/71HblAHs5xL._AC_UY879_-2.jpg",
                    39.99
                ),
                18 => new Product(
                    18,
                    "MBJ Women's Solid Short Sleeve Boat Neck V ",
                    "95% RAYON 5% SPANDEX, Made in USA or Imported, Do Not Bleach, Lightweight fabric with great stretch for comfort, Ribbed on sleeves and neckline / Double stitching on bottom hem",
                    "https://fakestoreapi.com/img/71z3kpMAYsL._AC_UY879_.jpg",
                    9.85
                ),
                19 => new Product(
                    19,
                    "Opna Women's Short Sleeve Moisture",
                    "100% Polyester, Machine wash, 100% cationic polyester interlock, Machine Wash & Pre Shrunk for a Great Fit, Lightweight, roomy and highly breathable with moisture wicking fabric which helps to keep moisture away, Soft Lightweight Fabric with comfortable V-neck collar and a slimmer fit, delivers a sleek, more feminine silhouette and Added Comfort",
                    "https://fakestoreapi.com/img/51eg55uWmdL._AC_UX679_.jpg",
                    7.95
                ),
                20 => new Product(
                    20,
                    "DANVOUY Womens T Shirt Casual Cotton Short",
                    "95%Cotton,5%Spandex, Features: Casual, Short Sleeve, Letter Print,V-Neck,Fashion Tees, The fabric is soft and has some stretch., Occasion: Casual/Office/Beach/School/Home/Street. Season: Spring,Summer,Autumn,Winter.",
                    "https://fakestoreapi.com/img/61pHAEJ4NML._AC_UX679_.jpg",
                    12.99
                ),
            ];
    }


    /**
     * @inheritDoc
     */
    public function saveOne(Product $product): Product
    {
        if (is_null($product->getId())) {
            $nextId = count($this->products) + 1;
            $productSaved = new Product($nextId, $product->getName(), $product->getDescription(), $product->getImage(), $product->getPrice());
            $this->products[$nextId] = $productSaved;

            return $productSaved;
        } else {
            $this->products[$product->getId()] = $product;

            return $product;
        }
    }

    /**
     * @inheritDoc
     */
    public function findOne(int $id): Product
    {
        if (!isset($this->products[$id])) {
            throw new ProductNotFoundException();
        }

        return $this->products[$id];
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        return array_values($this->products);
    }

    /**
     * @inheritDoc
     */
    public function removeOne(int $id): void
    {
        if (!isset($this->products[$id])) {
            throw new ProductNotFoundException();
        }

        unset($this->products[$id]);
    }
}
