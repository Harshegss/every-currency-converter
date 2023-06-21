<?php
if (!defined('ABSPATH')) {
	exit;
}

class Class_change_currency_select_widget extends \Elementor\Widget_Base
{

	public function get_name()
	{
		return 'Class_change_currency';
	}

	public function get_title()
	{
		return __('Currency Calculator', 'change-currency');
	}

	public function get_icon()
	{
		return 'eicon-product-upsell';
	}

	public function get_categories()
	{
		return ['basic'];
	}

	protected function _register_controls()
	{
		$this->start_controls_section(
			'section_image',
			[
				'label' => __('Settings', 'change-currency'),
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => esc_html__('Text Color', 'change-currency'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #change_currency_by_harsh' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Select Box Style', 'change-currency'),
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} #change_currency_by_harsh'
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => ['classic'],
				'selector' => '{{WRAPPER}} #change_currency_by_harsh'
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'label' => esc_html__('Select Box Border Type', 'change-currency'),
				'name' => 'border',
				'selector' => '{{WRAPPER}} #change_currency_by_harsh',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'label' => esc_html__('Select Box Box Shadow', 'change-currency'),
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} #change_currency_by_harsh',
			]
		);
		$this->add_control(
			'border_radius',
			[
				'label' => esc_html__('Select Box Border Radius', 'change-currency'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem'],
				'selectors' => [
					'{{WRAPPER}} #change_currency_by_harsh' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'padding',
			[
				'label' => esc_html__('Select Box Padding', 'change-currency'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem'],
				'selectors' => [
					'{{WRAPPER}} #change_currency_by_harsh' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}
	protected function render()
	{
		$setting = $this->get_settings_for_display();
		echo '<div id="every_currency_converter"><select id="change_currency_by_harsh" data-currency="' . get_woocommerce_currency() . '">
     <option value="">Change Currency</option>';
		foreach (get_option('wc_every_currency_converter_selector', array()) as $data) {
			echo '<option value="' . explode("|", $data)[0] . '" ' . (explode("|", $data)[0] == get_woocommerce_currency() ? 'selected' : '') . '>' . explode("|", $data)[1] . '</option>';
		}
		echo '</select></div>';
	}
}


