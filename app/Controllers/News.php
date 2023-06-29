<?php

namespace App\Controllers;

use App\Models\NewsModel;
use CodeIgniter\Config\Factories;
use CodeIgniter\Database\RawSql;
use CodeIgniter\Exceptions\PageNotFoundException;

class News extends BaseController
{
    public function forge()
    {
        $forge = \Config\Database::forge();
        /* ============== Create Database ============== */
        if ($forge->createDatabase('citesting',true)) {
            echo "<p>Database created</p>";
        }

        /* ============== Create Table and add fields ============== */
        $fields = [
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
            ],
            'author' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => 'King of Town',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['publish', 'pending', 'draft'],
                'default'    => 'pending',
            ],
        ];

        $forge->addField($fields);
        $forge->addKey('id', true);

        if ($forge->createTable('blogs', true)) {
            echo "<p>Table created</p>";
        }

        /* ============== Add New Columns to the Table ============= */
        $newFields = [
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
                'after' => 'status',
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
                'after' => 'created_at',
            ],
        ];
        
        if ($forge->addColumn('blogs', $newFields)) {
            echo "<p>New Columns Added</p>";
        }

        /* =============== Modify a Field in a Table =============== */
        $modifyFields = [
            'description' => [
                'type' => 'TEXT',
                'null' => false,
            ],
        ];
        if ($forge->modifyColumn('blogs', $modifyFields)) {
            echo "<p>Column 'description' Updated</p>";
        }



    }
    public function index()
    {
        $model = model(NewsModel::class);

        $data = array(
            'news' => $model->getNews(),
            'title' => 'News archive',
        );

        return view('templates/header', $data)
            . view('news/index', $data)
            . view('templates/footer');
    }

    public function view($slug = null)
    {
        $model = new NewsModel();
        $data['news'] = $model->getNews($slug);

        if (empty($data['news'])) {
            throw new PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title'];

        return view('templates/header', $data)
            . view('news/view')
            . view('templates/footer');
    }

    public function create()
    {
        helper('form');

        // Checks whether the form is submitted.
        if (! $this->request->is('post')) {
            // The form is not submitted, so returns the form.
            return view('templates/header', ['title' => 'Create a news item'])
                . view('news/create')
                . view('templates/footer');
        }

        $post = $this->request->getPost(['title', 'body']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($post, [
            'title' => 'required|max_length[255]|min_length[3]',
            'body'  => 'required|max_length[5000]|min_length[10]',
        ])) {
            // The validation fails, so returns the form.
            return view('templates/header', ['title' => 'Create a news item'])
                . view('news/create')
                . view('templates/footer');
        }

        //$model = model(NewsModel::class);

        $model = Factories::models('NewsModel');

        $model->save([
            'title' => $post['title'],
            'body'  => $post['body'],
        ]);

        return view('templates/header', ['title' => 'Create a news item'])
            . view('news/success', array("operation" => 'created'))
            . view('templates/footer');
    }

    public function edit($id)
    {
        helper('form');

        $model = model(NewsModel::class);
        $data['new'] = $model->find($id);

        return view('templates/header', ['title' => 'Edit a news item'])
            . view('news/edit', $data)
            . view('templates/footer');
    }

    public function update($id)
    {
        $post = $this->request->getPost(['title', 'body']);
        $newsModel = model(NewsModel::class);
        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($post, [
            'title' => 'required|max_length[255]|min_length[3]',
            'body'  => 'required|max_length[5000]|min_length[10]',
        ])) {
            $data['new'] = $newsModel->find($id);
            return view('templates/header', ['title' => 'Edit a news item'])
                . view('news/edit', $data)
                . view('templates/footer');
        }
        /*
        $newsModel->save(
            array(
                'id' => $id,
                'title' => $post['title'],
                'body' => $post['body'],
            )
        );
        */
        $newsModel->update($id, [
            'title' => $post['title'],
            'body' => $post['body'],
        ]);
        return view('templates/header', ['title' => 'Update a news item'])
            . view('news/success', array("operation" => 'updated'))
            . view('templates/footer');
    }

    public function delete($id)
    {
        $newsModel = model(NewsModel::class);
        $newsModel->delete($id);
        return view('templates/header', ['title' => 'Delete a new'])
            . view('news/success', ["operation" => 'deleted'])
            . view('templates/footer');
    }

}
