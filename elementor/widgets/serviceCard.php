<?php
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_service_Widget extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name(): string
    {
        return 'service';
    }

    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title(): string
    {
        return esc_html__('service', 'elementor-oembed-widget');
    }

    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon(): string
    {
        return 'eicon-code';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the card of categories the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget categories.
     */
    public function get_categories(): array
    {
        return ['general'];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the card of keywords the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords(): array
    {
        return ['oembed', 'url', 'link', 'service'];
    }

    /**
     * Get custom help URL.
     *
     * Retrieve a URL where the user can get more information about the widget.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget help URL.
     */
    public function get_custom_help_url(): string
    {
        return 'https://developers.elementor.com/docs/widgets/';
    }

    /**
     * Whether the widget requires inner wrapper.
     *
     * Determine whether to optimize the DOM size.
     *
     * @since 1.0.0
     * @access public
     * @return bool Whether to optimize the DOM size.
     */
    public function has_widget_inner_wrapper(): bool
    {
        return false;
    }

    /**
     * Whether the element returns dynamic content.
     *
     * Determine whether to cache the element output or not.
     *
     * @since 1.0.0
     * @access protected
     * @return bool Whether to cache the element output.
     */
    protected function is_dynamic_content(): bool
    {
        return false;
    }

    /**
     * Register oEmbed widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls(): void
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'card',
            [
                'label' => esc_html__('Repeater Card', 'textdomain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'card_img',
                        'label' => esc_html__('Choose Image', 'textdomain'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name' => 'card_title',
                        'label' => esc_html__('Title', 'textdomain'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('card Title', 'textdomain'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'card_content',
                        'label' => esc_html__('Content', 'textdomain'),
                        'type' => \Elementor\Controls_Manager::WYSIWYG,
                        'default' => esc_html__('card Content', 'textdomain'),
                        'show_label' => false,
                    ],
                ],
                'default' => [
                    [
                        'card_title' => esc_html__('Title #1', 'textdomain'),
                        'card_content' => esc_html__('Item content. Click the edit button to change this text.', 'textdomain'),
                    ],
                ],
                'title_field' => '{{{ card_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void
    {
        $settings = $this->get_settings_for_display();
        $card = $settings['card'];
?>

        <section class="services-section">
            <h2>Our Services</h2>
            <div class="services-container">
                <?php foreach ($card as $item) : ?>
                    <div class="service-box">
                        <img src="<?php echo $item['card_img']['url']; ?>" alt="">
                        <div class="service-title"><?php echo esc_html($item['card_title']); ?></div>
                        <div class="service-description"><?php echo wp_kses_post($item['card_content']); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <!-- <section class="services-section">
            <h2>Our Services</h2>
            <div class="services-container">
                <div class="service-box">
                    <div class="service-icon">🔧</div>
                    <div class="service-title">Maintenance</div>
                    <div class="service-description">We provide high-quality maintenance services for your equipment.</div>
                </div>
            </div>
        </section> -->


        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: Arial, sans-serif;
            }

            body {
                background-color: #f8f9fa;
            }

            .services-section {
                max-width: 1200px;
                margin: auto;
                padding: 60px 20px;
                text-align: center;
            }

            .services-section h2 {
                font-size: 2.5rem;
                margin-bottom: 20px;
                color: #333;
            }

            .services-container {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
                margin-top: 30px;
            }

            .service-box {
                background: #fff;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease-in-out;
                text-align: center;
            }

            .service-box:hover {
                transform: translateY(-5px);
            }

            .service-icon {
                font-size: 40px;
                color: #007bff;
                margin-bottom: 15px;
            }

            .service-title {
                font-size: 1.5rem;
                font-weight: bold;
                color: #333;
            }

            .service-description {
                font-size: 1rem;
                color: #666;
                margin-top: 10px;
            }
        </style>
<?php
    }
}
