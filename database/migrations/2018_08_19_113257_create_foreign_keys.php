<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('profiles', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('profiles')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('addresses', function(Blueprint $table) {
			$table->foreign('profile_id')->references('id')->on('profiles')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('addresses', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('addresses', function(Blueprint $table) {
			$table->foreign('region_id')->references('id')->on('regions')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('profile_id')->references('id')->on('profiles')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->foreign('subCategory_id')->references('id')->on('subCategories')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->foreign('brand_id')->references('id')->on('brands')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->foreign('discount_id')->references('id')->on('discounts')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('articles', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('images', function(Blueprint $table) {
			$table->foreign('article_id')->references('id')->on('articles')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('subCategories', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('line_orders', function(Blueprint $table) {
			$table->foreign('order_id')->references('id')->on('orders')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('line_orders', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('line_orders', function(Blueprint $table) {
			$table->foreign('profile_id')->references('id')->on('profiles')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('color_articles', function(Blueprint $table) {
			$table->foreign('color_id')->references('id')->on('colors')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('color_articles', function(Blueprint $table) {
			$table->foreign('article_id')->references('id')->on('articles')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('material_articles', function(Blueprint $table) {
			$table->foreign('article_id')->references('id')->on('articles')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('material_articles', function(Blueprint $table) {
			$table->foreign('material_id')->references('id')->on('materials')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('wishlists', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('wishlists', function(Blueprint $table) {
			$table->foreign('profile_id')->references('id')->on('profiles')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('compares', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('compares', function(Blueprint $table) {
			$table->foreign('profile_id')->references('id')->on('profiles')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('reviews', function(Blueprint $table) {
			$table->foreign('profile_id')->references('id')->on('profiles')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('reviews', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('rates', function(Blueprint $table) {
			$table->foreign('deliveryType_id')->references('id')->on('delivery_types')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('rates', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('payments', function(Blueprint $table) {
			$table->foreign('profile_id')->references('id')->on('profiles')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('payments', function(Blueprint $table) {
			$table->foreign('order_id')->references('id')->on('orders')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('deliveries', function(Blueprint $table) {
			$table->foreign('deliveryType_id')->references('id')->on('delivery_types')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('deliveries', function(Blueprint $table) {
			$table->foreign('order_id')->references('id')->on('orders')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('role_user', function(Blueprint $table) {
			$table->foreign('role_id')->references('id')->on('roles')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('role_user', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('profiles', function(Blueprint $table) {
			$table->dropForeign('profile_user_id_foreign');
		});
		Schema::table('addresses', function(Blueprint $table) {
			$table->dropForeign('address_profile_id_foreign');
		});
		Schema::table('addresses', function(Blueprint $table) {
			$table->dropForeign('address_city_id_foreign');
		});
		Schema::table('addresses', function(Blueprint $table) {
			$table->dropForeign('address_region_id_foreign');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('order_profile_id_foreign');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('product_category_id_foreign');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('product_subCategory_id_foreign');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('product_brand_id_foreign');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('product_discount_id_foreign');
		});
		Schema::table('articles', function(Blueprint $table) {
			$table->dropForeign('article_product_id_foreign');
		});
		Schema::table('images', function(Blueprint $table) {
			$table->dropForeign('image_article_id_foreign');
		});
		Schema::table('sub_categories', function(Blueprint $table) {
			$table->dropForeign('sub_category_category_id_foreign');
		});
		Schema::table('line_orders', function(Blueprint $table) {
			$table->dropForeign('line_order_order_id_foreign');
		});
		Schema::table('line_orders', function(Blueprint $table) {
			$table->dropForeign('line_order_product_id_foreign');
		});
		Schema::table('line_orders', function(Blueprint $table) {
			$table->dropForeign('line_order_profile_id_foreign');
		});
		Schema::table('color_articles', function(Blueprint $table) {
			$table->dropForeign('color_article_color_id_foreign');
		});
		Schema::table('color_articles', function(Blueprint $table) {
			$table->dropForeign('color_article_article_id_foreign');
		});
		Schema::table('material_articles', function(Blueprint $table) {
			$table->dropForeign('material_article_article_id_foreign');
		});
		Schema::table('material_articles', function(Blueprint $table) {
			$table->dropForeign('material_article_material_id_foreign');
		});
		Schema::table('wishlists', function(Blueprint $table) {
			$table->dropForeign('wishlist_product_id_foreign');
		});
		Schema::table('wishlists', function(Blueprint $table) {
			$table->dropForeign('wishlist_profile_id_foreign');
		});
		Schema::table('compares', function(Blueprint $table) {
			$table->dropForeign('compare_product_id_foreign');
		});
		Schema::table('compares', function(Blueprint $table) {
			$table->dropForeign('compare_profile_id_foreign');
		});
		Schema::table('reviews', function(Blueprint $table) {
			$table->dropForeign('review_profile_id_foreign');
		});
		Schema::table('reviews', function(Blueprint $table) {
			$table->dropForeign('review_product_id_foreign');
		});
		Schema::table('rates', function(Blueprint $table) {
			$table->dropForeign('rate_deliveryType_id_foreign');
		});
		Schema::table('rates', function(Blueprint $table) {
			$table->dropForeign('rate_city_id_foreign');
		});
		Schema::table('payments', function(Blueprint $table) {
			$table->dropForeign('payment_profile_id_foreign');
		});
		Schema::table('payments', function(Blueprint $table) {
			$table->dropForeign('payment_order_id_foreign');
		});
		Schema::table('deliveries', function(Blueprint $table) {
			$table->dropForeign('delivery_deliveryType_id_foreign');
		});
		Schema::table('deliveries', function(Blueprint $table) {
			$table->dropForeign('delivery_order_id_foreign');
		});
		Schema::table('role_user', function(Blueprint $table) {
			$table->dropForeign('role_user_role_id_foreign');
		});
		Schema::table('role_user', function(Blueprint $table) {
			$table->dropForeign('role_user_user_id_foreign');
		});
	}
}