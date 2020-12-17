@extends('layouts.app_react')
@section('title', 'タスク一覧')

@section('content')

<div class="panel panel-default" style="margin-top: 16px;">
    <div class="panel-heading">
        <div class="row">
            <div class="col-sm-6"><h3>Tasks - index</h3>
            </div>
            <div class="col-sm-6" style="text-align: right;">
                <a href="/tasks/create">[ new ]</a>
            </div>
        </div>
    </div>
    <div id="app"></div>    
</div>
<!-- -->
<!-- -->
<script type="text/babel" src="/js/component/Tasks/IndexRow.js?a3" ></script>

<script type="text/babel">
class List extends React.Component {
    constructor(props) {
        super(props);
        this.state = {data: ''}
    }
    componentDidMount(){
        this.get_items();
    }
    get_items(){
        axios.get("/api/apitasks/get_tasks").then(res =>  {
            var items = res.data
            var arr =[];
console.log(items );
            this.setState({ data: items })
        })
    }    
    tabRow(){
        if(this.state.data instanceof Array){
            return this.state.data.map(function(object, index){
                return <IndexRow obj={object} key={index} />
            })
        }
    }
    render(){
        return (
        <div>
            <table className="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                {this.tabRow()}
                </tbody>
            </table>            
        </div>
        )
    }
  
}

ReactDOM.render(<List />, document.getElementById('app'));
</script>
<style>
.p_tbl_task_name{ font-size: 1.2rem; }
.task-table td{ padding : 8px;}
/* .task-table .a_edit_link{ font-size : 1.2rem; } */
.task-table  td i {font-size : 1.2rem; }
</style>

@endsection

